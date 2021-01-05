<?php

namespace Live\Collection;

/**
 * File Collection 
 *
 * @package Live\Collection
 */

class FileCollection extends MemoryCollection
{
    /**
     * Index for the add a data on Collection.
     *
     * @param int $index
     * 
     */
    public $index;

    /**
     * Path to open file.
     *
     * @param string $file
     * 
     */
    public $file;

    /**
     * Timer
     *
     * @var $timer
     * 
     */
    public $timer;

    /**
     * Open File
     * 
     * {@inheritDoc}
     */
    public function openFile($fileName)
    {
        $this->index = 0;

        $this->file = $fileName;

        $fopen = fopen($this->file, "r");

        $fread = fread($fopen,filesize($fileName));

        fclose($fopen);

        $divideData = ";";

        $splitData = explode($divideData, $fread);

        foreach ($splitData as $string)
        {
            if ($string <> null){
                $this->index += 1;
                $this->set($this->index, $string, 5);
                //echo $this->index." | ".$this->get($this->index, null)."\n";                
            }

        }
    }

    /**
     * Write File
     * 
     * {@inheritDoc}
     */
    public function writeFile()
    {
        $fopen = fopen($this->file, "w");

        for ($i = 1; $i <= $this->index; $i++)
        {
            fwrite($fopen,strval($this->get($i, null)).";");

            //echo $i." | ".$this->get($i, null).";\n";
        }

        fclose($fopen);
    }

    /**
     * Insert Data on Collection
     * 
     * {@inheritDoc}
     */
    public function insertData($string)
    {
        $this->index += 1;
        $this->set($this->index, $string);
    }

    /**
     * Function that execute the program
     * 
     * {@inheritDoc}
     */
    public function execute($filepath)
    {
        $data = 0;
        $option = 0;

        $this->openFile("C:/development/Teste Live/php-test/dados.txt");

        $this->writeFile();

        /*while ($opcao == 0)
        {
            echo "Digite 1 para preencher novos dados, ou 2 para sair!\n";

            $opcao = readline("Digite uma opção: ");

            if ($opcao == 1)
            {
                $dado = readline("Digite o dado a ser inserido: ");

                $this->inserirDado($dado);

                $this->escreverArquivo();

                $opcao = 0;
            } 
        }*/
    }

    /**
     * Constructor
     * 
     * {@inheritDoc}
     */
    public function __construct()
    {
        $this->file = "C:/development/Teste Live/php-test/dados.txt";

        $this->timer = new Timer();
        $this->execute($this->file);
    }
}

new FileCollection();