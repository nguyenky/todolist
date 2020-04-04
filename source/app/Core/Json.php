<?php

namespace App\Core;

class Json
{
    private $statusCode;
    private $content;
    private $contentType;

    /**
     * Json constructor.
     *
     * @param string $content
     * @param int    $status
     */
    public function __construct(string $content = '', int $status = 200)
    {
        $this->setContentType('Content-Type: application/json;charset=utf-8')
            ->setContent($content)
            ->setStatusCode($status);
    }



    /**
     * @return string
     */
    public function getViewPath()
    {
        return $this->viewPath;
    }

    /**
     * @return mixed
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @return mixed
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param  mixed $statusCode
     * @return Json
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @param  mixed $content
     * @return Json
     */
    public function setContent($content)
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @param  string $contentType
     * @return Json
     */
    public function setContentType(string $contentType): Json
    {
        $this->contentType = $contentType;
        return $this;
    }
}
