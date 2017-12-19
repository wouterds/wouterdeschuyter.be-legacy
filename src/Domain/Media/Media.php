<?php

namespace WouterDeSchuyter\Domain\Media;

use JsonSerializable;
use WouterDeSchuyter\Domain\Users\UserId;

class Media implements JsonSerializable
{
    /**
     * @var MediaId
     */
    private $id;

    /**
     * @var UserId
     */
    private $userId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $contentType;

    /**
     * @var int
     */
    private $size;

    /**
     * @var string
     */
    private $md5;

    /**
     * @var string
     */
    private $createdAt;

    /**
     * @param UserId $userId
     * @param string $name
     * @param string $contentType
     * @param int $size
     */
    public function __construct(UserId $userId, string $name, string $contentType, int $size)
    {
        $this->id = new MediaId();
        $this->userId = $userId;
        $this->name = $name;
        $this->contentType = $contentType;
        $this->size = $size;
    }

    /**
     * @param array $data
     * @return Media
     */
    public static function fromArray(array $data): Media
    {
        $file = new Media(
            new UserId($data['user_id']),
            $data['name'],
            $data['content_type'],
            $data['size']
        );
        $file->id = new MediaId(!empty($data['id']) ? $data['id'] : null);
        $file->md5 = !empty($data['md5']) ? $data['md5'] : null;
        $file->createdAt = !empty($data['created_at']) ? $data['created_at'] : null;

        return $file;
    }

    /**
     * @return MediaId
     */
    public function getId(): MediaId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return '/' . $this->getId();
    }

    /**
     * @return UserId
     */
    public function getUserId(): UserId
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getContentType(): string
    {
        return $this->contentType;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @return string
     */
    public function getMd5(): string
    {
        return $this->md5;
    }

    /**
     * @param string $md5
     */
    public function setMd5(string $md5)
    {
        $this->md5 = $md5;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return get_object_vars($this);
    }
}