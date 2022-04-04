<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220404193451 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE quotidien (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, credit DOUBLE PRECISION DEFAULT NULL, debit DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE quotidien_mois (quotidien_id INT NOT NULL, mois_id INT NOT NULL, INDEX IDX_502374304A61D1BA (quotidien_id), INDEX IDX_50237430FA0749B8 (mois_id), PRIMARY KEY(quotidien_id, mois_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE quotidien_mois ADD CONSTRAINT FK_502374304A61D1BA FOREIGN KEY (quotidien_id) REFERENCES quotidien (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE quotidien_mois ADD CONSTRAINT FK_50237430FA0749B8 FOREIGN KEY (mois_id) REFERENCES mois (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE quotidien_mois DROP FOREIGN KEY FK_502374304A61D1BA');
        $this->addSql('DROP TABLE quotidien');
        $this->addSql('DROP TABLE quotidien_mois');
    }
}
