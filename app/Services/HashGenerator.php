<?php

namespace App\Services;

use Illuminate\Http\Response;
use Illuminate\Support\Str;

class HashGenerator
{
    private string $lenghtKey;
    private string $text;
    private int $loops;

    public function __construct(string $text, int $lenghtKey = 8, int $loops = 1000000)
    {
        $this->lenghtKey = $lenghtKey;
        $this->text = $text;
        $this->loops = $loops;
    }

    /**
     * @throws \DomainException
     * @return \stdClass
     */
    public function search(): \stdClass
    {
        $hashFound = new \stdClass;

        for ($i = 0; $i < $this->loops; $i++) {
            $key = $this->key();
            $hash =  md5($this->text . $key);

            if (substr($hash, 0, 4) === '0000') {
                $hashFound->enter_word = $this->text;
                $hashFound->key_found = $key;
                $hashFound->hash_found = $hash;
                $hashFound->number_try = $i;

                return $hashFound;
            }
        }

        throw new \DomainException('Hash not found', Response::HTTP_NOT_FOUND);
    }

    private function key(): string
    {
        return Str::random($this->lenghtKey);
    }
}
