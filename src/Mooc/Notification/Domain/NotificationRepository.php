<?php

declare(strict_types = 1);

namespace CodelyTv\Mooc\Notification\Domain;

interface NotificationRepository
{
    public function search(NotificationId $id): ?Notification;

    public function save(Notification $notification): void;
}
