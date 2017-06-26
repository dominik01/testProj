<?php

namespace Goodjob\AppBundle\Classes;

class Course
{

    private $em;

    public function __construct($em)
    {
        $this->em = $em;
    }

    public function showAll()
    {
        $courses = $this->getAll();
        return $courses;
    }

    public function showById($id)
    {
        $course = [];
        $courses = $this->getAll();
        if (!empty($courses[$id])) $course = $courses[$id];
        if (!empty($course['lector_id'])) {
            $classLector = new Lector($this->em);
            $lector = $classLector->showById($course['lector_id']);
            if (!empty($lector['name'])) $course['lector_name'] = $lector['name'];
            if (!empty($lector['photo'])) $course['lector_photo'] = $lector['photo'];
            if (!empty($lector['description'])) $course['lector_desc'] = $lector['description'];
        }
        return $course;
    }

    public function getAll()
    {
        $data = [
            'mongo-1' => [
                'id' => 1,
                'codeName' => 'mongo-1',
                'course_name' => 'Mongodb',
                'course_type' => 'Základný kurz',
                'video_link' => 'https://www.youtube.com/embed/W-WihPoEbR4',
                'basic_info' => 'V základnom kurze MongoDB, vhodnom aj pre začiatočníkov, si postupne vysvetlíme čo je MongoDB a aké je jeho využitie. Cieľom kurzu je okrem uvedenia do sveta schemaless databáz aj získať zručnosti na využitie MongoDB databázy v reálnom projekte.',
                'description' => 'Študenti tohto kurzu sa zoznámia so svetom schemaless databáz a jedným z jeho
                predstaviteľov, MongoDB. Postupne získajú všetky zručnosti potrebné na naprogramovanie jednoduchej
                aplikácie, ktorá využíva MongoDB ako svoj jediný databázový systém. Tieto zručnosti budú už počas kurzu
                aplikovať pri vytváraní jednoduchého blogu.',
                'lector_id' => 4,
                'what_you_learn' => '<ul>
                    <li>rozdiel medzi relačnými a schemaless databázami</li>
                    <li>kedy využiť MongoDB</li>
                    <li>používať mongo shell</li>
                    <li>základné typy dopytov</li>
                    <li>základy návrhu kolekcií</li>
                    <li>kedy ako a prečo indexovať</li>
                </ul>',
                'course_start' => new \DateTime('01-07-2016'),
                'course_end' => new \DateTime('01-09-2016'),
                'course_day' => 'Pondelky',
                'course_time' => '18:00-20:00',
                'course_period' => '8 tyzdnov',
                'course_price' => 279,
                'application_desc' => '<strong>Za 8 týždňov</strong> budeš schopný vytvoriť jednoduchú aplikáciu s použitím MongoDB'
            ],
            'nette-1' => [
                'id' => 2,
                'codeName' => 'nette-1',
                'course_name' => 'Nette for beginners',
                'course_type' => 'Novučičký workshop',
                'video_link' => 'https://www.youtube.com/embed/ta6CAYnNrUg',
                'basic_info' => 'PHP Framework Nette je vhodny pre webove aplikacie roznych rozmerov. Vdaka modularnosti frameworku je mozne ho pouzit na male projekty, ktore zvladnu aj zaciatocnici. Pocas kurzu si prejdeme vsetky zakladne aspekty tvorby webovych aplikacii v php. Pre absolvovanie kurzu je potrebne ovladat zaklady PHP, kedze ich budeme pocas celeho kurzu pouzivat',
                'description' => '<p>Pocas kurzu si vytvorime kompletnu funkcnu fitness aplikaciu pre manazment cviceni.
                    Po zvladnuti kurzu sa budu ucastnici orientovat v
                    zakladnej problematike webovych aplikacii. Budu vediet ako zacat pri tvorbe novych aplikacii pre
                    uskutocnenie svojich napadov, alebo aj ako sa orientovat uz v hotovych aplikaciach.</p>',
                'lector_id' => 1,
                'what_you_learn' => ' <ul>
                    <li>Zaklady prace vo fw Nette</li>
                    <li>Nette routing</li>
                    <li>Sablonovaci jazyk Latte</li>
                    <li>Formulare v Nette</li>
                    <li>Autorizacia v Nette</li>
                </ul>',
                'outline' =>
                    'Kurz je rozdeleny do 2 dni:
                    <ol style="list-style-type: none">
                        <li>1. den:
                            <ul>
                            <li>rozbehnutie zakladneho projektu (composer, nette skeleton, struktura,...)</li>
                            <li>vysvetlenie MVC v nette</li>
                            <li>routovanie v nette</li>
                            <li>sablonovaci jazyk latte</li>
                            <li>spolupraca s databazou</li>
                            </ul>
                        </li>
                        <li>2. den:
                            <ul>
                            <li> formulare</li>
                            <li>tvorba vlastnych komponentov</li>
                            <li>rozsirovanie latte</li>
                            <li>autorizacia</li>
                            </ul>
                        </li>
                    </ol>',
                'course_start' => new \DateTime('04-06-2016'),
                'course_end' => new \DateTime('05-06-2016'),
                'course_day' => 'Sobota a Nedela',
                'course_time' => '14:00-19:00',
                'course_period' => '2 dni',
                'course_price' => 279,
                'application_desc' => 'Prostrednictvom workshopu sa za 2 dni naucis <strong>prakticky pouzivat PHP framework Nette</strong>',
            ],
            'react' => [
                'id' => 3,
                'codeName' => 'react',
                'course_name' => 'React Native',
                'course_type' => 'Od web developmentu k native app developmentu',
                'video_link' => 'https://www.youtube.com/embed/n5RhAYhTxCk',
                'basic_info' => 'React Native je Javascript framework vychádzajúci z ReactJS. Jedná sa pomerne o novú technológiu, predstavenú v marci 2015 Facebookom. Cieľom Facebooku pre vytvorenie tohto frameworku bolo vytvoriť technológiu, pomocou ktorej budú môcť vývojári písať natívne aplikácie v jazyku Javascript, s vysokým percentom prepoužiteľnosti kódu medzi platformami (ios, Android, Windows Phone).',
                'description' => '     <p>Kurz je určený pre web developerov so znalosťou Javascriptu, ktorí chcú rozšíriť svoje portfólio o
                    tvorbu natívnych aplikácií. Ukážeme si, ako využiť naše doterajšie znalosti z web developmentu pre
                    vývoj v React Native. Počas vývoja reálnej aplikácie si vysvetlíme good practices vývoja pre
                    smartfóny.<br><br>Kurz je rozdelený do 2 dní:<br><br>1. deň:<br>- rozdiely medzi web developmentom a
                    app developmentom<br>- úvod do RN, rozdiely RN vs Native scripts / Cordoba<br>- environment setup,
                    setup simulátorov<br>- štruktúra projektu<br>- JSX<br>- renderovanie componentu, kompozícia
                    componentov<br>- Flexbox<br>- štýlovanie v React Native<br>- states and properties<br>- NPM
                    moduly<br><br><br>2. deň<br>- ES2016<br>- Network requesty<br>- práca s natívnym API - MapViews,
                    Fotogaléria<br>- úvod do Parse<br>- autentifikácia - registrácia a prihlásenie<br>- navigácia<br>-
                    pripravenie aplikácie na schválenie do Google Play, App Store<br><br><br>Po absolvovaní kurzu budú
                    vedieť účastnící vytvárať komplexné natívne aplikácie pre android a ios, ktoré budú používať natívne
                    API - mapy a fotogalériu. Budú sa orientovať v problematike app developmentu.</p>',
                'lector_id' => 5,
                'what_you_learn' => '<ul>
                    <li>tvoriť natívne appky pre ios, android a windows phone</li>
                    <li>odoslať aplikáciu do Google Store / App Store</li>
                </ul>',
                'course_start' => new \DateTime('01-07-2016'),
                'course_end' => new \DateTime('01-09-2016'),
                'course_day' => 'Pondelky',
                'course_time' => '18:00-20:00',
                'course_period' => '8 tyzdnov',
                'course_price' => 279,
                'application_desc' => 'Prostrednictvom intenzívneho kurzu sa za 2 dni naučíš vytvoriť svoju prvú natívnu appku',
            ],
            'digital_design_basic' => [
                'id' => 4,
                'codeName' => 'digital_design_basic',
                'course_name' => 'Digital Design Basic',
                'course_type' => '',
                'video_link' => 'https://www.youtube.com/embed/yqKHo1Q7OMc',
                'basic_info' => '',
                'description' => '<p>Kurz Digital Design je určený pre každého, kto by v dobe internetu a sociálnych sietí chcel vedieť samostatne tvoriť kvalitné grafické výstupy a ovládať program Adobe Photoshop. Naučíš sa vytvoriť si vlastné grafické banery pre svoj produkt, dizajnovať atraktívnu grafiku statusov na sociálne siete a spoznáš základné princípy reklamnej retuše, vyrezávania a úpravy produktových fotografií. Na kurze si samozrejme vysvetlíme základné teoretické princípy. Lekcie sú však zamerané primárne na praktické schopnosti. Cieľom inštruktora nie je len vysvetliť konkrétne postupy tvorby špecifických zadaní, ale vysvetliť súvislosti a praktické zručnosti tak, aby absolvent kurzu dokázal následne samostatne vytvárať vlastné grafické výstupy. Vďaka rozsiahlej praxi inštruktora kurzu, sa okrem "štandardných učebnicových postupov" dozvieš praktické rady zo života dizajnéra aj perličky z prostredia reklamy a marketingu. Naučíš sa "tajné" tipy, a efektívne postupy ktoré zabezpečia aby ťa práca s grafikou bavila a šla "od ruky". </p>',
                'lector_id' => 2,
                'what_you_learn' => '<ul>
                    <li>čo je to vôbec počítačová grafika a ako sa robí?</li>
                    <li>je rozdiel medzi grafikou a dizajnom?</li>
                    <li>v čom sa líši rastrová a vektorová grafika?</li>
                    <li>ako zistím, či "mám na to" stať sa dizajnérom?</li>
                    <li>čo znamenajú pojmy: rozlíšenie, RGB, CMYK, dpi, gamut a mnoho ďalších?</li>
                    <li>prečo máme rôzne formáty obrázkov JPEG, GIF, PNG PSD?</li>
                    <li>ako efektívne komunikovať s klientom pre ktorého tvoriš grafiku?</li>
                </ul>',
                'course_start' => new \DateTime('01-07-2016'),
                'course_end' => new \DateTime('01-08-2016'),
                'course_day' => '2x týždenne',
                'course_time' => '18:00-21:00',
                'course_period' => '4 týždne',
                'course_price' => 299,
                'application_desc' => '<li>prostredníctvom kurzu <b>získate pokročilé skúsenosti s grafickým programom  Adobe Photoshop</b></li>',
                'outline' => '<ol>
                            <li> lekcia - základné princípy dizajnu</li>
                            <li> lekcia - úvod do programu Adobe Photoshop, zoznámenie sa s rozhraním programu</li>
                            <li> lekcia - tvorba prvých grafických výstupov</li>
                            <li> lekcia - tvorba webových bannerov</li>
                            <li> lekcia - tvorba obrázkov pre sociálne média</li>
                            <li> lekcia - tréning správnych pracovných postupov, práca s rozličnými formátmi súborov</li>
                            <li> lekcia - princíp práce s maskami a retuš</li>
                            <li> lekcia - praktický tréning práce s maskami, retuš a digtálna koláž</li>
                            </ol>',
                'requirements' => 'Kurz je určený pre začiatočníkov'

            ],
            'nette-2' => [
                'id' => 5,
                'codeName' => 'nette-2',
                'course_name' => 'Advanced Nette',
                'course_type' => '',
                'video_link' => 'https://www.youtube.com/embed/ta6CAYnNrUg',
                'basic_info' => '',
                'description' => '<p>Kurz pokrocileho Nette je urceny pre programatorov, ktori uz s nette maju skusenosti, ale citia, ze stale z frameworku nevytazili vsetky jeho moznosti.</p>
                <p>Konkretne sa budeme do hlbky venovat temam ako Dependency Injection, modularnost aplikacii, tvorba api a rovnako je kurz otvoreny aj konzultaciam pre ucastnikov, kde sa mozme pozriet na realne problemy z praxe.</p>',
                'lector_id' => 1,
                'what_you_learn' => '',
                'outline' =>'
                    <ul>
                        <li>Depenceny Injection</li>
                        <li>ako rozsirovat DI container</li>
                        <li>testovanie (phpunit, nette tester, codeception)</li>
                        <li>udalosti</li>
                        <li>modularnost aplikacie, znovupouzitie</li>
                        <li>dalsie temy, o ktore by bol zaujem + best practices</li>
                    </ul>',
                'course_start' => new \DateTime('04-06-2016'),
                'course_end' => new \DateTime('05-06-2016'),
                'course_day' => 'Sobota a Nedela',
                'course_time' => '14:00-19:00',
                'course_period' => '2 dni',
                'course_price' => 279,
                'application_desc' => 'Prostrednictvom workshopu sa za 2 dni naucis <strong>prakticky pouzivat PHP framework Nette</strong>',
            ],
            'angular2-1' => [
                'id' => 6,
                'codeName' => 'angular2-1',
                'course_name' => 'Angular 2',
                'course_type' => 'Prvá aplikácia v',
                'video_link' => 'https://www.youtube.com/embed/XlqoPpLMdwY',
                'basic_info' => 'Angular 2 je nastupujúci frontendový framework, v ktorom je možné vyvíjať webové aj mobilné aplikácie. Angular 2 sa nezadržateľne blíži do svojej stabilnej verzie, čo je ideálny čas začať s jeho spoznávaním. Kurz bude po úvodnom zoznámení so zakladnými pojmami a technológiami prebiehať formou postupného budovania malej aplikácie. Jednotlivé súčasti Angularu si tak vysvetlíme teoreticky aj priamo v praxi. Kurz Vás prevedie všetkými dôležitými oblasťami, ktoré sú nevyhnutné pre vývoj aplikácie stredného rozsahu a poskytne základ pre daľšie štúdium.',
                'description' => '     <p>Kurz má za cieľ previesť študenta frameworkom Angular 2 takým spôsobom, aby bol na konci kurzu schopný vytvoriť hodnotnú stredne veľkú webovú aplikáciu. Zároveň poskytne aj jeden z možných postupov pri návrhu budúcej aplikácie a jej vývoji od skúseného profesionála. Postupne si vybudujeme aplikáciu, ktorú budeme na každej hodine vylepšovať na základe nových poznatkov. Prejdeme si jednotlivé stavebné prvky frameworku, prinútime ich medzi sebou komunikovať a vymienať si dáta, napojíme aplikáciu na server, budeme vedieť vkladať a vyťahovať prvky z databázy, upravovať ich za pomoci formulárov. Prejdeme si základy optimalizácie aplikácie a automatické testovanie. Na kurze budeme využívať okrem samotného Angularu aj Typescript, ktorý nám pomôže tvoriť čitateľný a moderný kód. Pre účasť na kurze nie je potrebná žiadna znalosť AngularJS (starej verzie), súčastou kurzu nie je ani migrácia kódu z AngularJS do Angular 2. Kurz bude vedený blokovou formou, jeden blok za týždeň.</p>',
                'lector_id' => 7,
                'what_you_learn' => '',
                'course_start' => new \DateTime('01-07-2016'),
                'course_end' => new \DateTime('01-09-2016'),
                'course_day' => 'Utorky a piatky',
                'course_time' => '15:00-17:00',
                'course_period' => '8 tyzdnov',
                'course_price' => 299,
                'application_desc' => '<li>prostrednictvom kurzu sa naučíš <b>vytvoriť použiteľnú aplikáciu v Angular 2</b></li>
                                       <li>lektor z praxe ti poskytne náhľad do komplexného procesu <b>vývoja modernej aplikácie</b></li>',
                'requirements' => '    <ul>
                    <li>Vlastný notebook s OS (Windows, Linux, OSX)</li>
                    <li>Znalosť Javascriptu</li>
                    <li>Základná znalosť HTML + CSS</li>
                </ul>',
                'outline' => '<p>Kurz je rozdelený do 10 blokov. Dĺžka jedného bloku je 3 x 45 minút, v prestávkach si môžeme dať
                    kávičku a nabrať sily. Témy v rámci jedného bloku budú prepojené.</p>
                <p><strong>1. Blok</strong></p>
                <ul>
                    <li>nastavenie vývojového prostredia</li>
                    <li>typescript</li>
                    <li>štruktúra projektu Angular 2</li>
                </ul>
                <p><strong>2. Blok</strong></p>
                <ul>
                    <li>základné stavebné prvky</li>
                    <li>naviazanie štýlov na komponenty</li>
                    <li>cyklus komponentu</li>
                </ul>
                <p><strong>3. Blok</strong></p>
                <ul>
                    <li>rozdiel medzi component a directive</li>
                    <li>pipes</li>
                </ul>
                <p><strong>4. Blok</strong></p>
                <ul>
                    <li>naviazanie štýlov na komponenty</li>
                    <li>tok dát a vzájomná komunikácia</li>
                </ul>
                <p><strong>5. Blok</strong></p>
                <ul>
                    <li>modularita</li>
                    <li>dependency injection</li>
                    <li>globálne premenné</li>
                </ul>
                <p><strong>6. Blok</strong></p>
                <ul>
                    <li>smerovanie a prepájanie častí aplikácie</li>
                    <li>vnorené stavy</li>
                    <li>http - prepojenie s backendovým API</li>
                </ul>
                <p><strong>7. Blok</strong></p>
                <ul>
                    <li>tvorba formulárov</li>
                    <li>vstavaná a custom validácia</li>
                </ul>
                <p><strong>8. Blok</strong></p>
                <ul>
                    <li>performance</li>
                    <li>testovanie</li>
                    <li>produkčná verzia</li>
                </ul>'
            ],
            'git' => [
                'id' => 7,
                'codeName' => 'git',
                'course_name' => 'GIT workshop',
                'course_type' => 'Naučte sa git od základov',
                'video_link' => 'https://www.youtube.com/embed/Y9XZQO1n_7c',
                'basic_info' => 'Tento kurz je určený pre ľudí ktorí sa chcú naučiť používať GIT, či už prechádzajú na git z iného verzionovacieho nástroja alebo je to ich prvý. Kurz je riadený interaktívne, s dôrazom na praktické vyskúšanie si jednotlivých vecí a ich porozumenie. Na to sú využívané praktické ukážky z reálneho života.',
                'description' => '     <p>Kurz bude vychádzať zo základného porozumenie gitu, čiže bude kladený dôraz na klasické používanie v konzole. Počas kurzu však prejdeme na klikací nástroj kde si ukážeme ako je možné git používať pohodlnejšie. Na konkrétnom nástroji sa môžeme dohodnúť podľa účastníkov a ich preferencií.</p>',
                'lector_id' => 1,
                'what_you_learn' => '',
                'course_start' => new \DateTime('01-07-2016'),
                'course_end' => new \DateTime('01-09-2016'),
                'course_day' => 'Stredy a piatky',
                'course_time' => '14:00-16:00',
                'course_period' => '10 tyzdnov',
                'course_price' => 259,
                'application_desc' => '<li>prostrednictvom kurzu sa naučíš <b>pracovať s Gitom</b></li>',
                'outline' => '<p>Kurz je rozdelený na 3 časti:</p>
                <ul>
                <li>1. Základy verzionovana a oboznámanie sa s pojmami potrebnými pre prácu s GIT-om. Lokálne verzionovanie.</li>
                <li>2. Práca s remote repozitármi - pracujeme v tíme. Reálne riešenie situácií, konflikty.</li>
                <li>3. Načrtnutie pokročilých tém, aké sú ďalšie možnosť v používaní a kde pokračovať ak sa chce človek posúvať ďalej a otázky.</li>
                </ul>'
            ],
            'autocad-1' => [
                'id' => 8,
                'codeName' => 'autocad-1',
                'course_name' => 'Autocad I - základy',
                'course_type' => 'Intenzívny kurz',
                'video_link' => 'https://www.youtube.com/embed/_ohxprrBLs0',
                'basic_info' => 'Základný kurz AutoCAD I sa venuje úvodu do CAD programov, začiatkom technického kreslenia a úpravám technickej dokumentácie. Je vhodný pre začiatočníkov.',
                'description' => '     <p>Cieľom kurzu je pochopiť základné a najviac používané nástroje v programe AutoCAD - kreslenie geometrických tvarov a modifikačné nástroje. Po absolvovaní kurz by mal uchádzač vedieť kresliť základné technické výkresy.</p>',
                'lector_id' => 3,
                'what_you_learn' => '
                <ul>
                    <li>čo obnáša technické kreslenie</li>
                    <li>aké sú alternatívne CADové programy na kreslenie</li>
                    <li>kreslenie geometrických prvkov</li>
                    <li>modifikačné </li>
                    <li>výstupom kurzu je znalosť základnej znalosti projektovania</li>
                </ul>
                ',
                'course_start' => new \DateTime('01-07-2016'),
                'course_end' => new \DateTime('01-09-2016'),
                'course_day' => 'Pondelky a piatky',
                'course_time' => '14:00-16:00',
                'course_period' => '2 tyzdne',
                'course_price' => 150,
                'application_desc' => '<li>prostrednictvom kurzu sa naučíš <b>základy práce so softvérom Autocad</b></li>',
            ]
        ];
        return $data;
    }

}

?>