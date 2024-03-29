<?php

namespace WouterDeSchuyter\Domain\Users;

interface UserRepository
{
    /**
     * @param User $user
     */
    public function add(User $user);

    /**
     * @return User[]
     */
    public function findAll(): array;

    /**
     * @param UserId[] $ids
     * @return User[]
     */
    public function findMultiple(array $ids): array;

    /**
     * @param UserId $id
     * @return null|User
     */
    public function find(UserId $id): ?User;

    /**
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User;

    /**
     * @param User $user
     */
    public function update(User $user);

    /**
     * @param UserId $id
     */
    public function delete(UserId $id);
}
