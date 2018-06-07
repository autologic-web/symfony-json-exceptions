<?php

namespace Autologic\JSONExceptions\ValueObject;

class Error
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $detail;

    /**
     * @var integer
     */
    private $status;

    /**
     * @param string $title
     * @param string $detail
     * @param integer $status
     */
    public function __construct($title, $detail, $status)
    {
        $this->title = $title;
        $this->detail = $detail;
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDetail()
    {
        return $this->detail;
    }

    /**
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'title'  => $this->title,
            'detail' => $this->detail,
            'status' => $this->status,
        ];
    }
}
