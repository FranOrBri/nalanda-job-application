<?php

declare(strict_types=1);

namespace Database\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250528084349 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE applicants (id VARCHAR(255) NOT NULL, recruiter_id VARCHAR(255) DEFAULT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, exp INT NOT NULL, cv VARCHAR(255) NOT NULL, is_valid TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_7FAFCADBE7927C74 (email), INDEX IDX_7FAFCADB156BE243 (recruiter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE recruiters (id VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE applicants ADD CONSTRAINT FK_7FAFCADB156BE243 FOREIGN KEY (recruiter_id) REFERENCES recruiters (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE applicants DROP FOREIGN KEY FK_7FAFCADB156BE243
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE applicants
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE recruiters
        SQL);
    }
}
