<?php

namespace App\Services;

use App\Kernel\Auth\User;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Upload\UploadedFileInterface;
use App\Models\Manhwa;
use App\Models\Review;

class ManhwaService
{
    public function __construct(
        private DatabaseInterface $db
    ) {
    }

    public function store(string $name, string $description, $image, $category, string $link): false|int
    {
        $filePath = $image->move('manhwas');

        return $this->db->insert('manhwas', [
            'name' => $name,
            'description' => $description,
            'preview' => $filePath,
            'category_id' => $category,
            'link' => $link,
        ]);
    }

    public function all(): array
    {
        $manhwas = $this->db->get('manhwas');

        return array_map(function ($manhwa) {
            return new Manhwa(
                $manhwa['id'],
                $manhwa['name'],
                $manhwa['description'],
                $manhwa['preview'],
                $manhwa['category_id'],
                $manhwa['created_at'],
                $manhwa['link'],
                $this->getReviews($manhwa['id']),
            );
        }, $manhwas);
    }

    public function delete(int $id): void
    {
        $this->db->delete('manhwas', [
            'id' => $id,
        ]);
    }

    public function find(int $id): ?Manhwa
    {
        $manhwa = $this->db->first('manhwas', [
            'id' => $id,
        ]);

        if (! $manhwa) {
            return null;
        }

        return new Manhwa(
            $manhwa['id'],
            $manhwa['name'],
            $manhwa['description'],
            $manhwa['preview'],
            $manhwa['category_id'],
            $manhwa['created_at'],
            $manhwa['link'],
            $this->getReviews($id),
        );
    }

    public function update(int $id, string $name, string $description, ?UploadedFileInterface $image, int $category, string $link): void
    {
        $data = [
            'name' => $name,
            'description' => $description,
            'category_id' => $category,
            'link' => $link,
        ];

        if ($image && ! $image->hasError()) {
            $data['preview'] = $image->move('manhwas');
        }

        $this->db->update('manhwas', $data, [
            'id' => $id,
        ]);
    }

    public function sum()
    {
        $result = $this->db->sum('manhwas');
        
        return $result;
    }

    public function search($text)
    {
        $manhwas = $this->db->search('manhwas', $text);
        
        return array_map(function ($manhwa) {
            return new Manhwa(
                $manhwa['id'],
                $manhwa['name'],
                $manhwa['description'],
                $manhwa['preview'],
                $manhwa['category_id'],
                $manhwa['created_at'],
                $manhwa['link'],
                $this->getReviews($manhwa['id']),
            );
        }, $manhwas);
    }

    public function categorySearch($id)
    {
        $manhwas = $this->db->categorySearch('manhwas', $id);
        
        return array_map(function ($manhwa) {
            return new Manhwa(
                $manhwa['id'],
                $manhwa['name'],
                $manhwa['description'],
                $manhwa['preview'],
                $manhwa['category_id'],
                $manhwa['created_at'],
                $manhwa['link'],
                $this->getReviews($manhwa['id']),
            );
        }, $manhwas);
    }

    public function new(): array
    {
        $manhwas = $this->db->get('manhwas', [], ['id' => 'DESC'], 10);

        return array_map(function ($manhwa) {
            return new Manhwa(
                $manhwa['id'],
                $manhwa['name'],
                $manhwa['description'],
                $manhwa['preview'],
                $manhwa['category_id'],
                $manhwa['created_at'],
                $manhwa['link'],
                $this->getReviews($manhwa['id']),
            );
        }, $manhwas);
    }

    private function getReviews(int $id): array
    {
        $reviews = $this->db->get('reviews', [
            'manhwa_id' => $id,
        ]);

        return array_map(function ($review) {
            $user = $this->db->first('users', [
                'id' => $review['user_id'],
            ]);

            return new Review(
                $review['id'],
                $review['rating'],
                $review['review'],
                $review['created_at'],
                new User(
                    $user['id'],
                    $user['email'],
                    $user['password'],
                    $user['name'],
                    $user['is_admin'],
                )
            );
        }, $reviews);
    }
}