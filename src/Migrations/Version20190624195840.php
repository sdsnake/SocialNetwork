<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190624195840 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post CHANGE user_rel_id INT NOT NULL');
        $this->addSql('ALTER TABLE post RENAME INDEX idx_5a8a6c8d9d86650f TO IDX_5A8A6C8D2B58BAF0');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post CHANGE user_rel_id user_rel_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE post RENAME INDEX idx_5a8a6c8d2b58baf0 TO IDX_5A8A6C8D9D86650F');
    }
}
