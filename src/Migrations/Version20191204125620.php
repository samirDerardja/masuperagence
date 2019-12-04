<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20191204125620 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE property_more_option (property_id INT NOT NULL, more_option_id INT NOT NULL, INDEX IDX_17C988D9549213EC (property_id), INDEX IDX_17C988D9233F78CB (more_option_id), PRIMARY KEY(property_id, more_option_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE property_more_option ADD CONSTRAINT FK_17C988D9549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE property_more_option ADD CONSTRAINT FK_17C988D9233F78CB FOREIGN KEY (more_option_id) REFERENCES more_option (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE more_option_property');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE more_option_property (more_option_id INT NOT NULL, property_id INT NOT NULL, INDEX IDX_CF81E445233F78CB (more_option_id), INDEX IDX_CF81E445549213EC (property_id), PRIMARY KEY(more_option_id, property_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE more_option_property ADD CONSTRAINT FK_CF81E445233F78CB FOREIGN KEY (more_option_id) REFERENCES more_option (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE more_option_property ADD CONSTRAINT FK_CF81E445549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE property_more_option');
    }
}
