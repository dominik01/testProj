<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 26.11.2014
 * Time: 17:14
 */

namespace Webron\ParserBundle\Classes;


class WebronNameParser {

    const BUNDLE_SIZE = 10;
    const NAME_POSITION_IN_BUNDLE = 5;
    private $text;
    private $delimitedText = [];
    private $persons = [];
    private static $slovak_names = ["Alexandra", "Daniela", "Drahoslav", "Andrea", "Antónia", "Bohuslava", "Severín", "Alexej", "Dáša", "Malvína", "Ernest", "Rastislav", "Radovan", "Dobroslav", "Kristína", "Nataša", "Bohdana", "Drahomíra", "Dalibor", "Vincent", "Zora", "Miloš", "Timotej", "Gejza", "Tamara", "Bohuš", "Alfonz", "Gašpar", "Ema", "Emil", "Tatiana", "Erik", "Blažej", "Veronika", "Agáta", "Dorota", "Vanda", "Zoja", "Zdenko", "Gabriela", "Dezider", "Perla", "Arpád", "Valentín", "Pravoslav", "Ida", "Miloslava", "Jaromír", "Vlasta", "Lívia", "Eleonora", "Etela", "Roman", "Matej", "Frederik", "Viktor", "Alexander", "Zlatica", "Radomír", "Albín", "Anežka", "Bohumil", "Kazimír", "Fridrich", "Radoslav", "Tomáš", "Alan", "Františka", "Branislav", "Angela", "Gregor", "Vlastimil", "Matilda", "Svetlana", "Boleslav", "Ľubica", "Eduard", "Jozef", "Víťazoslav", "Blahoslav", "Beňadik", "Adrián", "Gabriel", "Marián", "Emanuel", "Alena", "Soňa", "Miroslav", "Vieroslava", "Benjamín", "Hugo", "Zita", "Richard", "Izidor", "Miroslava", "Irena", "Zoltán", "Albert", "Milena", "Igor", "Július", "Estera", "Aleš", "Justínia", "Fedor", "Dana", "Rudolf", "Valér", "Jela", "Marcel", "Ervín", "Slavomír", "Vojtech", "Juraj", "Marek", "Jaroslava", "Jaroslav", "Jarmila", "Lea", "Anastázia", "Žigmund", "Galina", "Florián", "Lesana", "Hermína", "Monika", "Ingrid", "Roland", "Viktoria", "Blažena", "Pankrác", "Servác", "Bonifác", "Žofia", "Svetozár", "Gizela", "Viola", "Gertrúda", "Bernard", "Zina", "Júlia", "Želmíra", "Ela", "Urban", "Dušan", "Iveta", "Viliam", "Vilma", "Ferdinand", "Petronela", "Žaneta", "Xénia", "KarolĂna", "Lenka", "Laura", "Norbert", "Robert", "Medard", "Stanislava", "Margaréta", "Dobroslava", "Zlatko", "Anton", "Vasiľ", "Vít", "Blanka", "Adolf", "Vratislav", "Alfréd", "Valéria", "Alojz", "Paulína", "Sidonia", "Ján", "Tadeáš", "Adriana", "Ladislav", "Beáta", "Peter", "Melánia", "Diana", "Berta", "Miloslav", "Prokop", "Cyril", "Metod", "Patrik", "Oliver", "Ivan", "Lujza", "Amália", "Milota", "Nina", "Margita", "Kamil", "Henrich", "Drahomír", "Bohuslav", "Kamila", "Dušana", "Iľja", "Daniel", "Magdaléna", "Oľga", "Vladimír", "Jakub", "Anna", "Božena", "Krištof", "Marta", "Libuša", "Ignác", "Božidara", "Gustáv", "Jerguš", "Dominik", "Hortenzia", "Jozefína", "Štefánia", "Oskar", "Ľubomíra", "Vavrinec", "Zuzana", "Darina", "Ľubomír", "Mojmír", "Marcela", "Leonard", "Milica", "Elena", "Lýdia", "Anabela", "Jana", "Tichomír", "Filip", "Bartolomej", "Ľudovít", "Samuel", "Silvia", "Augustín", "Nikola", "Ružena", "Nora", "Drahoslava", "Linda", "Belo", "Rozália", "Regína", "Alica", "Mariana", "Miriama", "Martina", "Oleg", "Bystrík", "Mária", "Ctibor", "Ľudomil", "Jolana", "Ľudmila", "Olympia", "Eugénia", "Konštantín", "Ľuboslav", "Matúš", "Moric", "Zdenka", "Ľuboš", "Vladislav", "Edita", "Cyprián", "Václav", "Michal", "Jarolím", "Arnold", "Levoslav", "Stela", "František", "Viera", "Natália", "Eliška", "Brigita", "Dionýz", "Slavomira", "Valentína", "Maximilián", "Koloman", "Boris", "Terézia", "Vladimíra", "Hedviga", "Lukáš", "Kristián", "Vendelín", "Uršuľa", "Sergej", "Alojzia", "Kvetoslava", "Aurel", "Demeter", "Sabína", "Dobromila", "Klára", "Šimon", "Aurélia", "Denis", "Hubert", "Karol", "Imrich", "Renáta", "René", "Bohumír", "Teodor", "Tibor", "Martin", "Svätopluk", "Stanislav", "Irma", "Leopold", "Agnesa", "Klaudia", "Eugen", "Alžbeta", "Félix", "Elvíra", "Cecília", "Klement", "Emília", "Katarína", "Kornel", "Milan", "Henrieta", "Vratko", "Ondrej", "Edmund", "Bibiana", "Oldrich", "Barbora", "Oto", "Mikuláš", "Ambroz", "Marína", "Izabela", "Radúz", "Hilda", "Otília", "Lucia", "Branislava", "Ivica", "Albína", "Kornélia", "Sláva", "Judita", "Dagmara", "Bohdan", "Adela", "Nadežda", "Adam", "Eva", "Štefan", "Filoména", "Ivana", "Milada", "Dávid", "Silvester", "Maroš", "Petra", "Dominika", "Dagmar", "Marko", "Libor"];
    private static $slovak_degrees = [
        "before" => ['bc', 'mgr', 'art', 'rndr', 'pharmdr', 'phdr', 'judr', 'paeddr', 'thdr', 'ing', 'arch', 'mudr', 'mddr', 'mvdr', 'thlic'],
        "after" => ['phd', 'artd', 'thdr', 'drsc', 'csc', 'doc', 'prof']
    ];

    public function __construct($text='')
    {
        $this->text = $text;
    }

    /**
     * @return array of NameParser\Model\Persons
     */
    public function findPersons()
    {
        $this->text = str_replace(",", " a ", $this->text);
        $this->text = str_replace(";", " a ", $this->text);

        $this->persons = $this->localizeNames();
        return $this->persons;
    }

    private function localizeNames() {
        $persons = [];
        $lastKey = -2;
        $this->delimitedText = array_values(array_filter(preg_split("/\\r\\n|\\r|\\n|\\s/", $this->text)));
        foreach ($this->delimitedText as $key => $value) {
            if (array_search($value, self::$slovak_names) !== FALSE AND $key > $lastKey + 1) {
                $person = new PersonModel();
                $person->setFirstName($value);

                $this->recursiveParsePerson($person, $key);

                $person->setFullName($person->getBeforeDegree()
                    . " " . $person->getFirstName()
                    . " " . $person->getSurname()
                    . " " . $person->getAfterDegree());

                $person->setDegree($person->getBeforeDegree() . " " . $person->getAfterDegree());

                $persons[] = $person;
                $lastKey = $key;
            }
        }

        return $persons;
    }

    private function recursiveParsePerson(PersonModel $person, $key, $level = 1, $current = null) {
        //go to right
        if ($current != "left"
            AND isset($this->delimitedText[$key + 1])
            AND (($level == 1
                    AND $this->getLastCharacter($person->getFirstName()) != "."
                    AND $this->getFirstCharacter($this->delimitedText[$key + 1]) != ".")
                OR ($this->getLastCharacter($this->delimitedText[$key]) != ","
                    AND $this->getFirstCharacter($this->delimitedText[$key + 1]) != ","))
        )
        {
            switch (TRUE) {
                case $this->isDegree($this->delimitedText[$key + 1]):
                    $person->setBeforeDegree($this->delimitedText[$key + 1].($person->getBeforeDegree() ? " ".$person->getBeforeDegree() : ""));
                    $this->recursiveParsePerson($person, $key + 1, $level + 1, "right");
                    break;
                case $this->isDegree($this->delimitedText[$key + 1],"after"):
                    $person->setAfterDegree($this->delimitedText[$key + 1].($person->getAfterDegree() ? " ".$person->getAfterDegree() : ""));
                    $this->recursiveParsePerson($person, $key + 1, $level + 1, "right");
                    break;
                case ($this->isSurname($this->delimitedText[$key + 1]) AND !$person->getSurname()):
                    $person->setSurname($this->delimitedText[$key + 1]);
                    $this->recursiveParsePerson($person, $key + 1, $level + 1, "right");
                    break;
            }
        }
        //go to left
        if ($current != "right"
            AND isset($this->delimitedText[$key - 1])
            AND (($level == 1
                    AND $this->getFirstCharacter($person->getFirstName()) != "."
                    AND $this->getLastCharacter($this->delimitedText[$key - 1]) != ".")
                OR ($this->getFirstCharacter($this->delimitedText[$key]) != ","
                    AND $this->getLastCharacter($this->delimitedText[$key - 1]) != ","))
        )
        {
            switch (TRUE) {
                case $this->isDegree($this->delimitedText[$key - 1]):
                    $person->setBeforeDegree($this->delimitedText[$key - 1].($person->getBeforeDegree() ? " ".$person->getBeforeDegree() : ""));
                    $this->recursiveParsePerson($person, $key - 1, $level + 1, "left");
                    break;
                case $this->isDegree($this->delimitedText[$key - 1],"after"):
                    $person->setAfterDegree($this->delimitedText[$key - 1].($person->getAfterDegree() ? " ".$person->getAfterDegree() : ""));
                    $this->recursiveParsePerson($person, $key - 1, $level + 1, "left");
                    break;
                case ($this->isSurname($this->delimitedText[$key - 1]) AND !$person->getSurname()):
                    $person->setSurname($this->delimitedText[$key - 1]);
                    $this->recursiveParsePerson($person, $key - 1, $level + 1, "left");
                    break;
            }
        }
    }

    private function getLastCharacter($string) {
        return substr($string, -1);
    }

    private function getFirstCharacter($string) {
        return substr($string, 0, 1);
    }

    private function isDegree($string, $degreeType = "before") {
        if (array_search(mb_strtolower(str_replace([".",","],"",trim($string))), self::$slovak_degrees[$degreeType]) !== FALSE) {
            return TRUE;
        }

        return FALSE;
    }

    private function isSurname(&$string) {
        setlocale(LC_ALL, "sk_SK");
        //$pom = $string;
        //$pom = iconv(mb_detect_encoding($pom), "UTF-8", $pom);
        //setLocale(LC_CTYPE, "sk_SK.UTF-8");

        $string = trim($string," \t\n\r\0\x0B.,");

        //if (ctype_alpha($string) && ctype_upper($string[0]) && preg_match_all("/[A-Z]/", $string) == 1) {
        if (preg_match('/^\p{L}+$/u', $string) == 1 && ctype_upper($string[0]) /*&& preg_match_all("/[A-Z]/", $string) == 1*/) {

        return TRUE;
        }

        return FALSE;
    }
	
	public function getSlovakDegrees() {
		return self::$slovak_degrees;
	}
}

    class PersonModel
    {
        private $fullName = '';
        private $firstName = '';
        private $surname = '';
        private $degree = '';
        private $beforeDegree = '';
        private $afterDegree = '';

        public function __construct($fullName = "", $firstName = "", $surname = "", $degree = "")
        {
            $this->fullName = $fullName;
            $this->firstName = $firstName;
            $this->surname = $surname;
            $this->degree = $degree;
        }

        /**
         * @param string $degree
         */
        public function setDegree($degree)
        {
            $this->degree = $degree;
        }

        /**
         * @return string
         */
        public function getDegree()
        {
            return $this->degree;
        }

        /**
         * @param string $firstName
         */
        public function setFirstName($firstName)
        {
            $this->firstName = $firstName;
        }

        /**
         * @return string
         */
        public function getFirstName()
        {
            return $this->firstName;
        }

        /**
         * @param string $fullName
         */
        public function setFullName($fullName)
        {
            $this->fullName = $fullName;
        }

        /**
         * @return string
         */
        public function getFullName()
        {
            return $this->fullName;
        }

        /**
         * @param string $surname
         */
        public function setSurname($surname)
        {
            $this->surname = $surname;
        }

        /**
         * @return string
         */
        public function getSurname()
        {
            return $this->surname;
        }

        /**
         * @param mixed $afterDegree
         */
        public function setAfterDegree($afterDegree)
        {
            $this->afterDegree = $afterDegree;
        }

        /**
         * @return mixed
         */
        public function getAfterDegree()
        {
            return $this->afterDegree;
        }

        /**
         * @param mixed $beforeDegree
         */
        public function setBeforeDegree($beforeDegree)
        {
            $this->beforeDegree = $beforeDegree;
        }

        /**
         * @return mixed
         */
        public function getBeforeDegree()
        {
            return $this->beforeDegree;
        }

    }