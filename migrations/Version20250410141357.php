<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250410141357 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE recette_ingredient (recette_id INT NOT NULL, ingredient_id INT NOT NULL, INDEX IDX_17C041A989312FE9 (recette_id), INDEX IDX_17C041A9933FE08C (ingredient_id), PRIMARY KEY(recette_id, ingredient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recette_ingredient ADD CONSTRAINT FK_17C041A989312FE9 FOREIGN KEY (recette_id) REFERENCES recette (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recette_ingredient ADD CONSTRAINT FK_17C041A9933FE08C FOREIGN KEY (ingredient_id) REFERENCES ingredient (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recette DROP ingredient
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE recette_ingredient DROP FOREIGN KEY FK_17C041A989312FE9
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recette_ingredient DROP FOREIGN KEY FK_17C041A9933FE08C
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE ingredient
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE recette_ingredient
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE recette ADD ingredient LONGTEXT NOT NULL
        SQL);
    }
}
