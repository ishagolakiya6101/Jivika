<?php
namespace App\Traits;
use Illuminate\Support\Str;
trait HasSecureId
{
    protected static function bootHasSecureId()
    {
        static::creating(function ($model) {
            $model->generateSecureId();
        });
    }

    protected function generateSecureId()
    {
        $this->{$this->getSecureIdColumn()} = $this->generateRandomAlphanumericId(12); // Adjust length as needed
    }

    protected function generateRandomAlphanumericId($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $char_length = strlen($characters);
        $random_string = '';

        for ($i = 0; $i < $length; $i++) {
            $random_string .= $characters[rand(0, $char_length - 1)];
        }

        return $random_string;
    }

    public function getSecureIdColumn()
    {
        return isset($this->secureIdColumn) ? $this->secureIdColumn : 'secure_id';
    }

    public function getSecureIdAttribute()
    {
        return $this->attributes[$this->getSecureIdColumn()];
    }
}