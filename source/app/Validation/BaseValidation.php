<?php

namespace App\Validation;

use App\Exceptions\ValidateException;

abstract class BaseValidation
{
    /** @var array $values */
    protected $values;

    /** @var array $validators */
    protected $validators;

    public function __construct(array $values)
    {
        $this->values = $values;
    }

    abstract public function validator():array;

    public function handle()
    {
        $this->validators = $this->validator();

        if (empty($this->validators)) {
            return true;
        }

        foreach ($this->validators as $key => $validator) {
            foreach ($validator as $val) {
                if (preg_match('/^(\w+)\:(\w+)$/', $val)) {
                    $arrayRule = explode(':', $val);
                    $function = $arrayRule[0];
                    $validate = $this->$function($key, $this->values[$key] ?? null, $arrayRule[1]);
                } else {
                    $validate = $this->$val($key, $this->values[$key] ?? null);
                }

                if ($validate) {
                    throw new ValidateException($validate, 403);
                }
            }
        }

        return true;
    }

    private function required($key, $value)
    {
        if ($value !== null) {
            return;
        }

        return 'Attribute ' . $key . ' must required';
    }

    private function string($key, $value)
    {
        if (is_string($value)) {
            return;
        }

        return 'Attribute ' . $key . ' must be string';
    }

    private function minLength($key, $value, $rule)
    {
        if (!$value) {
            return;
        }

        if (strlen($value) >= $rule) {
            return;
        };

        return 'Attribute ' . $key . ' must min ' . $rule . ' characters';
    }

    private function maxLength($key, $value, $rule)
    {
        if (!$value) {
            return;
        }

        if (strlen($value) <= $rule) {
            return;
        };

        return 'Attribute ' . $key . ' must max ' . $rule . ' characters';
    }

    private function date($key, $date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        $validate = $d && $d->format($format) === $date;

        if ($validate) {
            return;
        }

        return 'Attribute ' . $key . ' must be date';
    }
}
