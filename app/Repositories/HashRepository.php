<?php

namespace App\Repositories;

use App\Models\Hash;
use Carbon\Carbon;
use Illuminate\Support\Str;

use function PHPUnit\Framework\isEmpty;

class HashRepository
{
    private Hash $model;
    private array $fields;

    public function __construct()
    {
        $this->model = new Hash;
        $this->fields = ['batch', 'block', 'enter_word', 'key_found'];
    }
    
    /**
     * @param \stdClass $hashFound
     * @return Hash
     */
    public function store(\stdClass $hashFound): Hash
    {
        $this->model->uuid = Str::uuid();
        $this->model->batch = Carbon::now();
        $this->model->enter_word = $hashFound->enter_word;
        $this->model->key_found = $hashFound->key_found;
        $this->model->hash_found = $hashFound->hash_found;
        $this->model->number_try = $hashFound->number_try;
        
        if (!$this->model->save()) {
            throw new \DomainException('Register not inserted');
        }

        return $this->model;
    }
    
    public function fetch(int $numberTry = null)
    {
        if (!empty($numberTry)) {
            return $this->model->select($this->fields)->where('number_try', '<', $numberTry)->paginate(20);
        }
        
        return $this->model->select($this->fields)->paginate(20);
    }
}