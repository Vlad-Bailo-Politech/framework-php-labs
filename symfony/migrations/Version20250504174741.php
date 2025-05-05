<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250504174741 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE book CHANGE author_id author_id INT NOT NULL, CHANGE title title VARCHAR(150) NOT NULL, CHANGE published_at published_at DATE NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE loan ADD due_date DATE NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX UNIQ_CC3F893CE7927C74 ON reader
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reader ADD phone VARCHAR(20) NOT NULL, DROP registered_at, CHANGE email email VARCHAR(150) NOT NULL, CHANGE full_name name VARCHAR(100) NOT NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE book CHANGE author_id author_id INT DEFAULT NULL, CHANGE title title VARCHAR(255) NOT NULL, CHANGE published_at published_at DATE DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE loan DROP due_date
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reader ADD registered_at DATETIME NOT NULL, DROP phone, CHANGE email email VARCHAR(255) NOT NULL, CHANGE name full_name VARCHAR(100) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_CC3F893CE7927C74 ON reader (email)
        SQL);
    }
}
