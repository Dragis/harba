<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20220821145705 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Added harbour table';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE harbour (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, uuid VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, lat VARCHAR(255) NOT NULL, lon VARCHAR(255) NOT NULL, is_price_hidden BOOLEAN NOT NULL, is_free BOOLEAN NOT NULL, can_book BOOLEAN NOT NULL, cash_only_bookings BOOLEAN NOT NULL, not_activated BOOLEAN NOT NULL, translations CLOB NOT NULL --(DC2Type:json)
        , accept_bank_payments BOOLEAN NOT NULL, accept_epay_payments BOOLEAN NOT NULL, accept_go_cardless_payments BOOLEAN NOT NULL, subscribed_berths_hidden_from_guests BOOLEAN NOT NULL, book_one_day_only BOOLEAN NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE harbour');
    }
}
