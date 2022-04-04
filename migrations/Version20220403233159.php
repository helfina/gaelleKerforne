<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220403233159 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE caf_mois (caf_id INT NOT NULL, mois_id INT NOT NULL, INDEX IDX_859DD8961CBD3657 (caf_id), INDEX IDX_859DD896FA0749B8 (mois_id), PRIMARY KEY(caf_id, mois_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE caf_mois ADD CONSTRAINT FK_859DD8961CBD3657 FOREIGN KEY (caf_id) REFERENCES caf (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE caf_mois ADD CONSTRAINT FK_859DD896FA0749B8 FOREIGN KEY (mois_id) REFERENCES mois (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE caf_mois');
    }
}
