<?php

namespace Goodjob\AppBundle\Classes;

class Lector{

	private $em;

	public function __construct($em){
		$this->em = $em;
	}

	public function showAll(){
		$lectors = $this->getAll();
		return $lectors;
	}

	public function showById($id){
		$retval = [];
		$lectors = $this->getAll();
		if(!empty($lectors[$id])) $retval = $lectors[$id];
		return $retval;
	}

	private function getAll(){
		$lectors = array(
            1 => array(
                'name' => 'Tomáš Majer',
                'photo' => 'bundles/goodjob/images/lektor-tomas-majer.jpg',
                'position' => 'Senior developer',
                'description' => 'Tomáš sa web developmentu venuje viac ako 10 rokov. Počas tohto obdobia pracoval 8 rokov vo firme MONOGRAM, kde začínal ako prvý zamestnanec a zažil nárast technologickej firmy z jedného človeka na 80 zamestnancov. Väčšinu času pracoval v tíme, kde bolo jeho úlohou viesť programátorov ako team leader, navrhovanie architektúry pre nové projekty, najímanie nových programátorov a rovnako pomoc oddeleniam ako sales a marketing pri odhadoch a spracovávaní nových výziev. Jeho záľubou je návrh a optimalizácia aplikácií pre chod pod veľkou záťažou, skúšanie nových technológií a posúvanie limitov.',
                'short_desc' => 'Tomáš sa web developmentu venuje viac ako 10 rokov. Počas tohto obdobia pracoval 8 rokov vo firme MONOGRAM, kde začínal ako..',
				'courses' => array(
                    1 => array('name' => 'GIT workshop', 'url' => 'git'),
                    2 => array('name' => 'Nette workshop for beginners', 'url' => 'nette-1'),
                    3 => array('name' => 'Nette workshop advanced', 'url' => 'nette-2')
                )
            ),
            2 => array(
                'name' => 'Matej Pavlanský',
                'photo' => 'bundles/goodjob/images/lektor-matej-pavlansky.png',
                'position' => 'Digital graphic designer',
                'description' => 'Matej pracuje v oblasti reklamy a dizajnu už od svojich 17 rokov. Má skúsenosti z niekoľkých webových štúdií a relkamných agentúr, kde ukladal pixle ako Webdesigner, Digital Designer a Art Director. Ovláda tvorbu printovej aj digitálnej grafiky a ako absolvent odboru Marketingová komunikácia myslí na to, aby výsledkom jeho práce nebol len pekný dizajn, ale zároveň aj efektívny marketingový nástroj. V súčasnosti je na voľnej nohe a okrem práce pre klientov sa venuje aj niekoľkým vlastným projektom.',
				'short_desc' => 'Matej pracuje v oblasti reklamy a dizajnu už od svojich 17 rokov. Má skúsenosti z niekoľkých webových štúdií a relkamných agentúr..',
				'courses' => array(
					1 => array('name' => 'Digital Design Basic', 'url' => 'digital_design_basic')
                )
            ),
            3 => array(
                'name' => 'Ing. arch. Peter Horák',
                'photo' => 'bundles/goodjob/images/lektor-peter-horak.jpg',
                'position' => 'Architect',
                'description' => 'Študent tretieho-doktorandského stupňa na Fakulte Architektúry Slovenskej Technickej Univerzity v Bratislave. Absolvent semestrálneho štúdia na Newcastle University, Veľká Británia. Lektor grafických programov na Fakulte Architektúry STU od roku 2014. Má praktické znalosti s tvorbou vizualizácií, prípravou projektovej dokumentácie a momentálne sa podieľa na urbanistických projektoch spracovávaných do 3D animačných výstupov.
                                  Motto: "Nie som klasický učiteľ. Neučím len program. Snažím sa ľuďom či študentom ukázať, že učenie je hra. Stále sa dá niečo nové objaviť. A stále je dôvod sa posúvať vpred!"',
				'short_desc' => 'Študent tretieho-doktorandského stupňa na Fakulte Architektúry Slovenskej Technickej Univerzity v Bratislave. Absolvent semestrálneho..',
				'courses' => array(
                    1 => array('name' => 'Kurz Autocad I.', 'url' => 'autocad-1'),
                    2 => array('name' => 'Kurz Autocad II.', 'url' => 'autocad-2'),
                    3 => array('name' => 'Kurz Autocad III.', 'url' => 'autocad-3')
                )
            ),
            4 => array(
                'name' => 'Michal Chylik',
                'photo' => 'bundles/goodjob/images/lektor-michal-chylik.jpg',
                'position' => 'Senior developer',
                'description' => 'Michal začal s web developmentom pred ôsmimi rokmi, vývojom manažérskych hier v PowerPlay Manager. Popri štúdiu softvérového inžinierstva pracoval na viacerých projektoch ako freelancer. Má skúsenosti s vlastným startupom, ale aj s korporátnou sférou. Postupne si vyskúšal pozície junior developera, team leadera, project managera a momentálne zastáva pozíciu CTO vo vlastnej firme Vashino. Práca zahŕňa aj zaúčanie a vedenie junior developerov. Špecializuje sa na backend a najviac si rozumie s PHP, Symfony, MongoDB a MySQL.',
				'short_desc' => 'Michal začal s web developmentom pred ôsmimi rokmi, vývojom manažérskych hier v PowerPlay Manager. Popri štúdiu softvérového..',
				'courses' => array(
                    1 => array('name' => 'Mongo DB', 'url' => 'mongo-1'),
                )
            ),
            5 => array(
                'name' => 'Michal Fehér',
                'photo' => 'bundles/goodjob/images/lektor-michal-feher.jpg',
                'position' => 'Senior Lead Developer',
                'description' => 'Michal pozná web development z každej stránky. V korporátnej oblasti ako Senior Developer a Project Lead zodpovedný za vývoj interných toolov, vo freelance oblasti ako Lead Developer pre firmy 2fresh, Provocation Bureau, Blue Kiwi a v business oblasti ako CEO/CTO niekoľkých komerčných startupov aj neziskových projektov. Veľký fanúšik technológií ReactJS a React Native. Práve cez React Native sa Michal dostal z tvorby webových aplikácií k tvorbe natívných smartphone aplikácií.',
				'short_desc' => 'Michal pozná web development z každej stránky. V korporátnej oblasti ako Senior Developer a Project Lead zodpovedný za vývoj interných..',
				'courses' => array(
                    1 => array('name' => 'React Native - Od web developmentu k native app developmentu', 'url' => 'react'),


                )
            ),
            6 => array(
                'name' => 'Peter Šíma',
                'photo' => 'bundles/goodjob/images/lektor-peter-sima.jpg',
                'position' => 'Senior AddGuru',
                'description' => 'Peter je držiteľom Google Adwords certifikátu s dlhoročnými skúsenosťami v marketingu vo vyhľadávačoch, webovej analytike a optimalizácii web stránok. Mal možnosť pracovať pre spoločnosti ako ESET v USA alebo UBIMET – dcérsku firmu spoločnosti Reb Bull. V súčasnosti ako Google Partner pomáha niekoľkým menším spoločnostiam a neziskovým organizáciám vyťažiť maximum z online marketingu. Oceňuje transparentnosť a férovosť v živote aj biznise.',
				'short_desc' => 'Peter je držiteľom Google Adwords certifikátu s dlhoročnými skúsenosťami v marketingu vo vyhľadávačoch, webovej analytike a..',
				'courses' => array(
                    1 => array('name' => 'Adwords', 'url' => 'adwords')
                )
            ),
            7 => array(
                'name' => 'Adam Kobyda',
                'photo' => 'bundles/goodjob/images/lektor-adam-kobyda.png',
                'position' => 'Frontend nadšenec',
                'description' => 'Adam začínal s vývojom webových riešení v roku 2004. Za ten čas mal možnosť si vyskúsať všetky pozície od návrhu grafiky až po optimalizáciu databáz na širokej škále robustných aplikácií a startupov. Nakoniec zakotvil pri návrhu UX a frontendových technológiách na pozícii team leader. Ako nadšenec Google a inovácií sa už od úplného začiatku venuje Angular 2 a Material design konceptu, kde vo vlastnej firme priviedol ako jeden z prvých do produkcie aplikácie postavené na týchto technológiách.',
				'short_desc' => 'Adam začínal s vývojom webových riešení v roku 2004. Za ten čas mal možnosť si vyskúsať všetky pozície od návrhu grafiky až po..',
				'courses' => array(
                    1 => array('name' => 'Angular2 - tvorba prvej aplikácie', 'url' => 'angular2-1'),
                   // 2 => array('name' => 'Angular2 - workshop', 'url' => 'angular2-2')
                )
            )
        );
		return $lectors;
	}

}

?>