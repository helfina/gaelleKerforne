<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220404011919 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE prelevement (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, credit DOUBLE PRECISION DEFAULT NULL, debit DOUBLE PRECISION DEFAULT NULL, date_debut DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prelevement_mois (prelevement_id INT NOT NULL, mois_id INT NOT NULL, INDEX IDX_A332E6FECE389617 (prelevement_id), INDEX IDX_A332E6FEFA0749B8 (mois_id), PRIMARY KEY(prelevement_id, mois_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pret_maison (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, credit DOUBLE PRECISION DEFAULT NULL, debit DOUBLE PRECISION DEFAULT NULL, date_debut DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pret_maison_mois (pret_maison_id INT NOT NULL, mois_id INT NOT NULL, INDEX IDX_D416ED302C0728E0 (pret_maison_id), INDEX IDX_D416ED30FA0749B8 (mois_id), PRIMARY KEY(pret_maison_id, mois_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE revenues (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, credit DOUBLE PRECISION DEFAULT NULL, debit DOUBLE PRECISION DEFAULT NULL, date_debut DATE DEFAULT NULL, date_fin DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE revenues_mois (revenues_id INT NOT NULL, mois_id INT NOT NULL, INDEX IDX_2DEA118FD08BC1CD (revenues_id), INDEX IDX_2DEA118FFA0749B8 (mois_id), PRIMARY KEY(revenues_id, mois_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE prelevement_mois ADD CONSTRAINT FK_A332E6FECE389617 FOREIGN KEY (prelevement_id) REFERENCES prelevement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prelevement_mois ADD CONSTRAINT FK_A332E6FEFA0749B8 FOREIGN KEY (mois_id) REFERENCES mois (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pret_maison_mois ADD CONSTRAINT FK_D416ED302C0728E0 FOREIGN KEY (pret_maison_id) REFERENCES pret_maison (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pret_maison_mois ADD CONSTRAINT FK_D416ED30FA0749B8 FOREIGN KEY (mois_id) REFERENCES mois (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE revenues_mois ADD CONSTRAINT FK_2DEA118FD08BC1CD FOREIGN KEY (revenues_id) REFERENCES revenues (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE revenues_mois ADD CONSTRAINT FK_2DEA118FFA0749B8 FOREIGN KEY (mois_id) REFERENCES mois (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE caf ADD date_fin DATE DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prelevement_mois DROP FOREIGN KEY FK_A332E6FECE389617');
        $this->addSql('ALTER TABLE pret_maison_mois DROP FOREIGN KEY FK_D416ED302C0728E0');
        $this->addSql('ALTER TABLE revenues_mois DROP FOREIGN KEY FK_2DEA118FD08BC1CD');
        $this->addSql('DROP TABLE prelevement');
        $this->addSql('DROP TABLE prelevement_mois');
        $this->addSql('DROP TABLE pret_maison');
        $this->addSql('DROP TABLE pret_maison_mois');
        $this->addSql('DROP TABLE revenues');
        $this->addSql('DROP TABLE revenues_mois');
        $this->addSql('ALTER TABLE caf DROP date_fin');
    }
}
