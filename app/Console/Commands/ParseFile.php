<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Psy\Readline\Hoa\ConsoleException;

class ParseFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:parse-file
                            {fileName=test.txt : name of file that should be parsed}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse file and remove any words that begin or end with the letter “R”';

    /**
     * Execute the console command.
     * receive file name (or default 'test.txt')
     * filter words in file
     * return array of strings that not contains which that begin or end with the letter “R”
     * @throws ConsoleException
     * @var string $fileName - name of test file
     */
    public function handle(): array
    {
        $fileName = $this->argument('fileName');
        $filePath = storage_path("testFiles/$fileName") ;

        if (!file_exists($filePath)) {
            throw new ConsoleException("File $filePath not found");
        }

        $fileData = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        $filteredData = array_filter($fileData, function($word) {
            $fLetter = mb_strtolower(substr($word, 0, 1));
            $lLetter = mb_strtolower(substr($word, -1));
            return !in_array('r', [$fLetter, $lLetter]);
        });

        sort($filteredData);

        print_r($filteredData);
        return $fileData;
    }
}
