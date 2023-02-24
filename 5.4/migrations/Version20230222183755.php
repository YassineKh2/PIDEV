<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230222183755 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE despense ADD session_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE despense ADD CONSTRAINT FK_EB12D333613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EB12D333613FECDF ON despense (session_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE despense DROP FOREIGN KEY FK_EB12D333613FECDF');
        $this->addSql('DROP INDEX UNIQ_EB12D333613FECDF ON despense');
        $this->addSql('ALTER TABLE despense DROP session_id');
    }
}
