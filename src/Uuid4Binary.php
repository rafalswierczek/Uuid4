<?php

declare(strict_types=1);

namespace rafalswierczek\Uuid4;

final class Uuid4Binary
{
    public function __construct(private string $binary)
    {
        self::validate($binary);
    }

    public function __toString(): string
    {
        return $this->binary;
    }

    public function get(): string
    {
        return $this->binary;
    }
    
    public function toHex(): Uuid4
    {
        $hexString = unpack('H*', $this->binary)[1];
        
        $uuid4 = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split($hexString, 4));

        return new Uuid4($uuid4);
    }
    
    public function equals(self $uuid4Binary): bool
    {
        return $uuid4Binary->get() === $this->binary;
    }

    public static function validate(string $binary): void
    {
        $hexString = unpack('H*', $binary)[1];

        if (32 !== strlen($hexString)) {
            throw new \Exception('Invalid length of binary UUID v4');
        }
    }
}