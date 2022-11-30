<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221129104109 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE first_name_stat_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE first_name_stat (id INT NOT NULL, gender INT NOT NULL, first_name VARCHAR(255) NOT NULL, year_of_birth INT DEFAULT NULL, count INT NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE first_name_stat_id_seq CASCADE');
        $this->addSql('DROP TABLE first_name_stat');
    }
}
