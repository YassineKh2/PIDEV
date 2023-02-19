<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230217100607 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activite_centre (id INT AUTO_INCREMENT NOT NULL, planning_id INT DEFAULT NULL, jour_activite VARCHAR(255) NOT NULL, nom_activite VARCHAR(255) NOT NULL, contenu_activite VARCHAR(255) NOT NULL, heure_debut_activite TIME NOT NULL, heure_fin_activite TIME NOT NULL, nombre_participant_activite_max INT NOT NULL, INDEX IDX_BFC22E113D865311 (planning_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, nom_admin VARCHAR(255) NOT NULL, password_admin VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE adresse (id INT AUTO_INCREMENT NOT NULL, nom_rue VARCHAR(255) NOT NULL, num_rue INT NOT NULL, code_postal INT NOT NULL, gouvernorat VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, categorie_id INT DEFAULT NULL, pannier_id INT DEFAULT NULL, nom_article VARCHAR(255) NOT NULL, prix_article DOUBLE PRECISION NOT NULL, quantite_article INT NOT NULL, image_article VARCHAR(255) NOT NULL, INDEX IDX_23A0E66BCF5E72D (categorie_id), INDEX IDX_23A0E66662C2FA2 (pannier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, nom_categorie VARCHAR(255) NOT NULL, image_categorie VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE centre (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, nom_centre VARCHAR(255) NOT NULL, capacite_centre INT NOT NULL, nombre_bloc_centre INT NOT NULL, UNIQUE INDEX UNIQ_C6A0EA754DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commantaire_publication (id INT AUTO_INCREMENT NOT NULL, publication_id INT DEFAULT NULL, date_commantaire DATE NOT NULL, contenu_commantaire VARCHAR(255) NOT NULL, INDEX IDX_AB54DB8938B217A7 (publication_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE despense (id INT AUTO_INCREMENT NOT NULL, libelle_despense VARCHAR(255) NOT NULL, montant_despense DOUBLE PRECISION NOT NULL, reduction_despense DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, organisateur_id INT DEFAULT NULL, nom_evenement VARCHAR(255) NOT NULL, date_evenement DATE NOT NULL, nombre_participant_evenement INT NOT NULL, prix_evenement DOUBLE PRECISION NOT NULL, type_evenement VARCHAR(255) NOT NULL, INDEX IDX_B26681ED936B2FA (organisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formateur (id INT AUTO_INCREMENT NOT NULL, nom_formateur VARCHAR(255) NOT NULL, prenom_formateur VARCHAR(255) NOT NULL, sexe_formateur VARCHAR(255) NOT NULL, email_formateur VARCHAR(255) NOT NULL, num_tel_formateur INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, nom_formation VARCHAR(255) NOT NULL, niveau_formation INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE module_formation (id INT AUTO_INCREMENT NOT NULL, formation_id INT DEFAULT NULL, nom_formation VARCHAR(255) NOT NULL, prerequis_module VARCHAR(255) NOT NULL, duree_module VARCHAR(255) NOT NULL, contenu_module VARCHAR(255) NOT NULL, INDEX IDX_1A213E775200282E (formation_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE organisateur (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, nom_organisateur VARCHAR(255) NOT NULL, num_tel_organisateur INT NOT NULL, pourcentage_revenu_organisateur DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_4BD76D444DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pannier (id INT AUTO_INCREMENT NOT NULL, client_id INT DEFAULT NULL, prix_total_painner DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_AED0E5EB19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, therapist_id INT DEFAULT NULL, id_utilisateur_id INT DEFAULT NULL, point INT NOT NULL, INDEX IDX_1ADAD7EB43E8B094 (therapist_id), UNIQUE INDEX UNIQ_1ADAD7EBC6EE5C49 (id_utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE planning_centre (id INT AUTO_INCREMENT NOT NULL, centre_id INT DEFAULT NULL, date_debut_planning DATE NOT NULL, date_fin_planning DATE NOT NULL, INDEX IDX_A681C81A463CD7C3 (centre_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE publication (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, date_publication DATE NOT NULL, contenu_publication VARCHAR(255) NOT NULL, INDEX IDX_AF3C6779FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reaction_publication (id INT AUTO_INCREMENT NOT NULL, publication_id INT DEFAULT NULL, utilisateur_id INT DEFAULT NULL, INDEX IDX_EC2A804F38B217A7 (publication_id), UNIQUE INDEX UNIQ_EC2A804FFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, date_debut_session DATE NOT NULL, date_fin_session DATE NOT NULL, nombre_participant_session INT NOT NULL, difficulte VARCHAR(255) NOT NULL, description_session VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE therapist (id INT AUTO_INCREMENT NOT NULL, id_utilisateur_id INT DEFAULT NULL, adresse_id INT DEFAULT NULL, num_tel_therapist INT NOT NULL, UNIQUE INDEX UNIQ_C3D632FC6EE5C49 (id_utilisateur_id), UNIQUE INDEX UNIQ_C3D632F4DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, formation_id INT DEFAULT NULL, session_id INT DEFAULT NULL, nom_utilisateur VARCHAR(255) NOT NULL, prenom_utilisateur VARCHAR(255) NOT NULL, pseudo_utilisateur VARCHAR(255) NOT NULL, email_utilisateur VARCHAR(255) NOT NULL, password_utilisateur VARCHAR(255) NOT NULL, INDEX IDX_1D1C63B35200282E (formation_id), INDEX IDX_1D1C63B3613FECDF (session_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur_evenement (utilisateur_id INT NOT NULL, evenement_id INT NOT NULL, INDEX IDX_6B889D32FB88E14F (utilisateur_id), INDEX IDX_6B889D32FD02F13 (evenement_id), PRIMARY KEY(utilisateur_id, evenement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE activite_centre ADD CONSTRAINT FK_BFC22E113D865311 FOREIGN KEY (planning_id) REFERENCES planning_centre (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66662C2FA2 FOREIGN KEY (pannier_id) REFERENCES pannier (id)');
        $this->addSql('ALTER TABLE centre ADD CONSTRAINT FK_C6A0EA754DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE commantaire_publication ADD CONSTRAINT FK_AB54DB8938B217A7 FOREIGN KEY (publication_id) REFERENCES publication (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681ED936B2FA FOREIGN KEY (organisateur_id) REFERENCES organisateur (id)');
        $this->addSql('ALTER TABLE module_formation ADD CONSTRAINT FK_1A213E775200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE organisateur ADD CONSTRAINT FK_4BD76D444DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE pannier ADD CONSTRAINT FK_AED0E5EB19EB6921 FOREIGN KEY (client_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB43E8B094 FOREIGN KEY (therapist_id) REFERENCES therapist (id)');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE planning_centre ADD CONSTRAINT FK_A681C81A463CD7C3 FOREIGN KEY (centre_id) REFERENCES centre (id)');
        $this->addSql('ALTER TABLE publication ADD CONSTRAINT FK_AF3C6779FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE reaction_publication ADD CONSTRAINT FK_EC2A804F38B217A7 FOREIGN KEY (publication_id) REFERENCES publication (id)');
        $this->addSql('ALTER TABLE reaction_publication ADD CONSTRAINT FK_EC2A804FFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE therapist ADD CONSTRAINT FK_C3D632FC6EE5C49 FOREIGN KEY (id_utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE therapist ADD CONSTRAINT FK_C3D632F4DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresse (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B35200282E FOREIGN KEY (formation_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE utilisateur_evenement ADD CONSTRAINT FK_6B889D32FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur_evenement ADD CONSTRAINT FK_6B889D32FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE activite_centre DROP FOREIGN KEY FK_BFC22E113D865311');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66BCF5E72D');
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66662C2FA2');
        $this->addSql('ALTER TABLE centre DROP FOREIGN KEY FK_C6A0EA754DE7DC5C');
        $this->addSql('ALTER TABLE commantaire_publication DROP FOREIGN KEY FK_AB54DB8938B217A7');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681ED936B2FA');
        $this->addSql('ALTER TABLE module_formation DROP FOREIGN KEY FK_1A213E775200282E');
        $this->addSql('ALTER TABLE organisateur DROP FOREIGN KEY FK_4BD76D444DE7DC5C');
        $this->addSql('ALTER TABLE pannier DROP FOREIGN KEY FK_AED0E5EB19EB6921');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EB43E8B094');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EBC6EE5C49');
        $this->addSql('ALTER TABLE planning_centre DROP FOREIGN KEY FK_A681C81A463CD7C3');
        $this->addSql('ALTER TABLE publication DROP FOREIGN KEY FK_AF3C6779FB88E14F');
        $this->addSql('ALTER TABLE reaction_publication DROP FOREIGN KEY FK_EC2A804F38B217A7');
        $this->addSql('ALTER TABLE reaction_publication DROP FOREIGN KEY FK_EC2A804FFB88E14F');
        $this->addSql('ALTER TABLE therapist DROP FOREIGN KEY FK_C3D632FC6EE5C49');
        $this->addSql('ALTER TABLE therapist DROP FOREIGN KEY FK_C3D632F4DE7DC5C');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B35200282E');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3613FECDF');
        $this->addSql('ALTER TABLE utilisateur_evenement DROP FOREIGN KEY FK_6B889D32FB88E14F');
        $this->addSql('ALTER TABLE utilisateur_evenement DROP FOREIGN KEY FK_6B889D32FD02F13');
        $this->addSql('DROP TABLE activite_centre');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE adresse');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE centre');
        $this->addSql('DROP TABLE commantaire_publication');
        $this->addSql('DROP TABLE despense');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE formateur');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE module_formation');
        $this->addSql('DROP TABLE organisateur');
        $this->addSql('DROP TABLE pannier');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE planning_centre');
        $this->addSql('DROP TABLE publication');
        $this->addSql('DROP TABLE reaction_publication');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE therapist');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE utilisateur_evenement');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
