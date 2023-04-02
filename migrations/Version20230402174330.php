<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230402174330 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE expenses (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, user_id INTEGER DEFAULT NULL, expensestype_id INTEGER NOT NULL, date DATETIME NOT NULL, amount DOUBLE PRECISION NOT NULL, registeringdate DATETIME NOT NULL, companyname VARCHAR(255) NOT NULL, CONSTRAINT FK_2496F35BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_2496F35B68EB0B0 FOREIGN KEY (expensestype_id) REFERENCES expenses_type (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_2496F35BA76ED395 ON expenses (user_id)');
        $this->addSql('CREATE INDEX IDX_2496F35B68EB0B0 ON expenses (expensestype_id)');
        $this->addSql('CREATE TABLE expenses_type (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, label VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, mail VARCHAR(320) NOT NULL, birthday DATETIME DEFAULT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE expenses');
        $this->addSql('DROP TABLE expenses_type');
        $this->addSql('DROP TABLE user');
    }
}
