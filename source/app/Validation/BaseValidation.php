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

    /**
     * Handle validation
     *
     * @return bool|ValidateException
     */
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

    /**
     * Check validate value request
     * @param string $key
     * @param mixed $value
     *
     * @return bool|string
     */
    private function required(string $key, $value)
    {
        if ($value !== null) {
            return false ;
        }

        return 'Attribute ' . $key . ' must required';
    }

    /**
     * Check validate value is string
     * @param string $key
     * @param mixed $value
     *
     * @return bool|string
     */
    private function string($key, $value)
    {
        if (is_string($value)) {
            return false;
        }

        return 'Attribute ' . $key . ' must be string';
    }

    /**
     * Check validate min length
     * @param string $key
     * @param mixed $value
     * @param integer $rule
     *
     * @return bool|string
     */
    private function minLength($key, $value, $rule)
    {
        if (!$value) {
            return false;
        }

        if (strlen($value) >= $rule) {
            return false;
        };

        return 'Attribute ' . $key . ' must min ' . $rule . ' characters';
    }

    /**
     * Check validate max length
     * @param string $key
     * @param mixed $value
     * @param integer $rule
     *
     * @return bool|string
     */
    private function maxLength($key, $value, $rule)
    {
        if (!$value) {
            return false;
        }

        if (strlen($value) <= $rule) {
            return false;
        };

        return 'Attribute ' . $key . ' must max ' . $rule . ' characters';
    }

    /**
     * Check validate value is date
     * @param string $key
     * @param mixed $date
     * @param string $format
     *
     * @return bool|string
     */
    private function date($key, $date, $format = 'Y-m-d')
    {
        $d = \DateTime::createFromFormat($format, $date);
        $validate = $d && $d->format($format) === $date;

        if ($validate) {
            return false;
        }

        return 'Attribute ' . $key . ' must be date';
    }
}
