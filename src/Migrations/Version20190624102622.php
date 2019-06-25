<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190624102622 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D9D86650F');
        $this->addSql('DROP INDEX IDX_5A8A6C8D9D86650F ON post');
        $this->addSql('ALTER TABLE post ADD user_rel_id INT NOT NULL, DROP UserRel_id');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D2B58BAF0 FOREIGN KEY (user_rel_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D2B58BAF0 ON post (user_rel_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post DROP FOREIGN KEY FK_5A8A6C8D2B58BAF0');
        $this->addSql('DROP INDEX IDX_5A8A6C8D2B58BAF0 ON post');
        $this->addSql('ALTER TABLE post ADD UserRel_id INT DEFAULT NULL, DROP user_rel_id');
        $this->addSql('ALTER TABLE post ADD CONSTRAINT FK_5A8A6C8D9D86650F FOREIGN KEY (UserRel_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5A8A6C8D9D86650F ON post (UserRel_id)');
    }
}
