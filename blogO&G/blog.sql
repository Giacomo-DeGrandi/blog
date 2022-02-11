-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Creato il: Feb 11, 2022 alle 08:34
-- Versione del server: 5.7.31
-- Versione PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article` text NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `articles`
--

INSERT INTO `articles` (`id`, `article`, `id_utilisateur`, `id_categorie`, `date`) VALUES
(1, 'Lithium fields: Beautiful from the air, trouble on the ground. For geothermal fields around the world, produced geothermal brine has been simply injected back underground, but now it\'s become clear that the brines produced at the Salton Sea geothermal field contain an immense amount of lithium, a critical resource need for low-carbon transportation and energy storage. Demand for lithium is skyrocketing, as it is an essential ingredient in lithium-ion batteries. Researchers have recently published a comprehensive review of past and current technologies for extracting minerals from geothermal brine. ', 1, 1, '2022-01-29 05:20:56'),
(2, 'Jitter Recipes: Book 1, Recipes 0-12\r\nJitter Recipes: Book 1, Recipes 0-12\r\nSo, you\'ve finished the tutorials, you understand the basics of digital audio, and you can imagine using a jitter matrix for something. Perhaps you are looking for a couple of new recipes to expand your repertoire...\r\nThe following is a collection of simple examples that began as weekly posts to the Max mailing list. Here you will find some clever solutions, advanced trans-coding techniques, groovy audio/visual toys, and basic building blocks for more complex processing. The majority of these recipes are specific implementations of a more general patching concept. As with any collection of recipes, you will want to take these basic techniques and personalize them for your own uses. I encourage you to take them all apart, add in your own touches and make these your own.', 4, 2, '2022-01-29 05:20:57'),
(3, 'Trend Cemetery: Long Live Mugler. Welcome to Trend Cemetery, a new bi-weekly column where our Senior Editor Taylore Scarabelli tries to make sense of meaningless micro-trends, luxury fashion, and street style in the age of social media. This week, she mourns the loss of  Thierry Mugler, glamour, and André Leon Talley. \r\n\r\n———\r\n\r\nAs the late André Leon Talley once said, “It’s been a bleak streak over here in America…It’s a famine of beauty.” That was a quote from the 2009 documentary, The September Issue, but it lands in 2022—not only because of a supposed dearth of innovation on the runways and in our feeds—but because style, in the contemporary milieu, feels devoid of glamour. In 2022, the dominant silhouette is oversized, and the most common looks at fashion events mix bright colors and logos in the way advertisements at sporting arenas might. This is not to say that we are without ostentation in fashion, but rather that our collective fashion fantasy has more to do with looking bold than it does with character building or storytelling. Bucket hats and flight jackets rear their comfortable silhouettes season after season, only slightly altered to mirror trending colorways or particular brands. And though consumers seem to be growing tired of the dominant normcore-inspired fashion du-jour, we continue buying bigger boots and bags, all in the hopes of getting attention online, and off.', 9, 3, '2022-01-29 05:20:58'),
(4, 'The ‘surprisingly simple’ arithmetic of smell. Smell a cup of coffee.\r\n\r\nSmell it inside or outside; summer or winter; in a coffee shop with a scone; in a pizza parlor with pepperoni -- even at a pizza parlor with a scone! -- coffee smells like coffee.\r\n\r\nWhy don\'t other smells or different environmental factors \"get in the way,\" so to speak, of the experience of smelling individual odors? Researchers at the McKelvey School of Engineering at Washington University in St. Louis turned to their trusted research subject, the locust, to find out.\r\n\r\nWhat they found was \"surprisingly simple,\" according to Barani Raman, professor of biomedical engineering. Their results were published in the journal Proceedings of the National Academy of Sciences.\r\n\r\nRaman and colleagues have been working with locusts for years, watching their brains and their behaviors related to smell in an attempt to engineer bomb-sniffing locusts. Along the way, they\'ve made substantial gains when it comes to understanding the mechanisms at play when it comes to locusts\' sense of smell.', 1, 1, '2022-01-29 05:21:00'),
(5, 'The Rapper and Hedi Slimane Muse\r\nLeikeli47 Eats Interview for Breakfast.\r\n\r\nYou may not recognize Leikeli47 on the street—in fact, nobody would. But you’ve likely heard her music. The rapper and producer, who wears a mask during public appearances, has maintained a low profile that has allowed her music—joyful, genre-bending hip-hop—to speak for itself. After spending years posting tracks online and subsisting on SoundCloud likes, the Brooklyn-based musician’s no-fucks-given exuberance caught the attention of Jay-Z in 2015 (the track in question, a warm weather anthem titled “Fuck the Summer Up,” was the namesake of his inaugural Tidal playlist). In 2017, Leikeli47 released her debut album, a hip-hop rule breaker titled Wash & Set, and quickly followed up with 2018’s critically-acclaimed Acrylic, which included the Issa Rae-approved banger “Girl Blunt.” This year, hot off the release of her new single “Chitty Bang,” Leikeli47 crossed paths with Celine’s creative director, Hedi Slimane. The photographer and designer was so captivated by the rapper’s sound and mystique that he couldn’t resist the urge to photograph her. To learn more about Celine’s latest muse, we sat down with Leikeli47 to discuss her journey from SoundCloud to festival stage, working with Hedi, and eating Interview for breakfast.', 9, 2, '2022-02-07 06:57:28'),
(6, 'Number of Earth\'s tree species estimated to be 14% higher than currently known, with some 9,200 species yet to be discovered.\r\n\r\nA new study involving more than 100 scientists from across the globe and the largest forest database yet assembled estimates that there are about 73,000 tree species on Earth, including about 9,200 species yet to be discovered.\r\n\r\nThe global estimate is about 14% higher than the current number of known tree species. Most of the undiscovered species are likely to be rare, with very low populations and limited spatial distribution, the study shows.\r\n\r\nThat makes the undiscovered species especially vulnerable to human-caused disruptions such as deforestation and climate change, according to the study authors, who say the new findings will help prioritize forest conservation efforts.\r\n\r\n\"These results highlight the vulnerability of global forest biodiversity to anthropogenic changes, particularly land use and climate, because the survival of rare taxa is disproportionately threatened by these pressures,\" said University of Michigan forest ecologist Peter Reich, one of two senior authors of a paper scheduled for publication Jan. 31 in Proceedings of the National Academy of Sciences.\r\n\r\n\"By establishing a quantitative benchmark, this study could contribute to tree and forest conservation efforts and the future discovery of new trees and associated species in certain parts of the world,\" said Reich, director of the Institute for Global Change Biology at U-M\'s School for Environment and Sustainability.\r\n\r\nFor the study, the researchers combined tree abundance and occurrence data from two global datasets -- one from the Global Forest Biodiversity Initiative and the other from TREECHANGE -- that use ground-sourced forest-plot data. The combined databases yielded a total of 64,100 documented tree species worldwide, a total similar to a previous study that found about 60,000 tree species on the planet.\r\n\r\n\"We combined individual datasets into one massive global dataset of tree-level data,\" said the study\'s other senior author, Jingjing Liang of Purdue University, coordinator of the Global Forest Biodiversity Initiative.\r\n\r\n\"Each set comes from someone going out to a forest stand and measuring every single tree -- collecting information about the tree species, sizes and other characteristics. Counting the number of tree species worldwide is like a puzzle with pieces spread all over the world.\"\r\n\r\nAfter combining the datasets, the researchers used novel statistical methods to estimate the total number of unique tree species at biome, continental and global scales -- including species yet to be discovered and described by scientists. A biome is a major ecological community type, such as a tropical rainforest, a boreal forest or a savanna.\r\n\r\nTheir conservative estimate of the total number of tree species on Earth is 73,274, which means there are likely about 9,200 tree species yet to be discovered, according to the researchers, who say their new study uses a vastly more extensive dataset and more advanced statistical methods than previous attempts to estimate the planet\'s tree diversity. The researchers used modern developments of techniques first devised by mathematician Alan Turing during World War II to crack Nazi code, Reich said.\r\n\r\nRoughly 40% of the undiscovered tree species -- more than on any other continent -- are likely to be in South America, which is mentioned repeatedly in the study as being of special significance for global tree diversity.\r\n\r\nSouth America is also the continent with the highest estimated number of rare tree species (about 8,200) and the highest estimated percentage (49%) of continentally endemic tree species -- meaning species found only on that continent.\r\n\r\nHot spots of undiscovered South American tree species likely include the tropical and subtropical moist forests of the Amazon basin, as well as Andean forests at elevations between 1,000 meters (about 3,300 feet) and 3,500 meters (about 11,480 feet).\r\n\r\n\"Beyond the 27,000 known tree species in South America, there might be as many as another 4,000 species yet to be discovered there. Most of them could be endemic and located in diversity hot spots of the Amazon basin and the Andes-Amazon interface,\" said Reich, who was recruited by U-M\'s Biosciences Initiative and joined the faculty last fall from the University of Minnesota, where he maintains a dual appointment.\r\n\r\n\"This makes forest conservation of paramount priority in South America, especially considering the current tropical forest crisis from anthropogenic impacts such as deforestation, fires and climate change,\" he said.\r\n\r\nWorldwide, roughly half to two-thirds of all already known tree species occur in tropical and subtropical moist forests, which are both species-rich and poorly studied by scientists. Tropical and subtropical dry forests likely hold high numbers of undiscovered tree species, as well.\r\n\r\n\"Extensive knowledge of tree richness and diversity is key to preserving the stability and functioning of ecosystems,\" said study lead author Roberto Cazzolla Gatti of the University of Bologna in Italy.\r\n\r\nForests provide many \"ecosystem services\" to humanity for free. In addition to supplying timber, fuelwood, fiber and other products, forests clean the air, filter the water, and help control erosion and flooding. They help preserve biodiversity, store climate-warming carbon, and promote soil formation and nutrient cycling while offering recreational opportunities such as hiking, camping, fishing and hunting.\r\n', 1, 1, '2022-02-07 10:29:49'),
(7, 'Nostalgia of a Catastrophe or The Catastrophe Without Nostalgia\r\n\r\nThe composer Núria Giménez-Comas (© Christophe Egea)\r\n\r\nDirector Anne Monfort and composer Núria Giménez-Comas have embarked on a two-pronged project based on Anja Hilling\'s play Nostalgie 2175. On one hand, a stage production, which will tour throughout France from January 2022, on the other hand, a \"Music-Fiction\" with Ambisonic sound diffusion. For us, they reveal the different issues, including social and ecological ones, that seduced them in the German playwright\'s text.', 1, 2, '2022-02-07 15:39:45'),
(8, 'Klein’s Approachable Avant-Garde\r\nFor her new album Harmattan, singer/producer Klein asked esteemed academic and poet Fred Moten to write the liner notes. The way she connected with Moten was slightly unusual. “Really and truly, he commented on one of my Youtube videos,” she says, laughing. “We got to talking, and I was like, ‘Do you want to write a little blurb?’ And some of the things he wrote I didn’t see in [the album] originally, so I was like ‘Yeah, I’m a decomposer!’” It’s a quirky yet completely on-brand story for the London-based musician, one that highlights her deep comfort within both music’s fringes and its mainstream.\r\n\r\nMoten isn’t the only creative type with whom Klein has collaborated over the last few years, and Harmattan is in some ways the result of Klein exploring her musical circle. “Unknown Opps” features saxophonist Keahnne Whitby and Khush Jandu Quiney, the latter of whom was in her band when she opened for Moor Mother in 2019. “I would literally just meet someone on Instagram and be like ‘Oh, you play! Cool, cool.’ So it was just natural, and we were just chilling until I asked if they want to be on my track.” Welsh opera singer Charlotte Church guested on “Skyfall” after introducing herself when Klein opened for Bjork on the Utopia tour. She describes her collaborations as genial: “A lot of people I work with are friends first, or just for fun. I’m shy, and I get nervous that I have nothing to bring to the table. But over time, I’ve gotten more confident. I don’t think I’m going to ruin the track anymore.”', 4, 2, '2022-02-07 19:52:26'),
(9, 'Life Lessons from André Leon Talley\r\n“Darling, clothes are not important in this pandemic. What’s important is your strength that comes from your faith, your values. All of that is very ingrained in you, so therefore you can survive.”\r\n\r\n(2020)\r\n\r\nWelcome to Life Lessons. Today, we mourn the loss of one of our own—the inimitable André Leon Talley. News of the trailblazing fashion editor’s passing came late on Tuesday night, sparking a flood of tearful tributes and joyful memorials in honor of this towering (six-foot-six) cultural icon. André began his storied career in the offices of this very publication—as a receptionist for Andy Warhol—and rose to claim the carefully gate-kept title of Creative Director and Editor at Large of Vogue not long thereafter. In the years since, André, a Black queer man raised in the Jim Crow South, relentlessly rewrote the fashion industry’s rules, dressing First Ladies, casting Naomi Campbell in a reimagined “Gone With the Wind” shoot for Vanity Fair, and carving out space in the magazine world’s highest echelons—all in his signature uniform of oversized furs and candy-colored kaftans. To mark an icon’s passing, we’re bringing together the brightest moments from our decades’ worth of interviews with André, courtesty of the likes of Carolina Herrera (1981), Michael Kors (2019), Gloria von Thurn und Taxis (2020), and Demna Gavasalia (2021). So sit back and grab a pen, darling—you just might learn a thing or two.', 4, 3, '2022-02-08 05:20:56'),
(10, 'New cloud-based platform opens genomics data to all          Harnessing the power of genomics to find risk factors for major diseases or search for relatives relies on the costly and time-consuming ability to analyze huge numbers of genomes. A team co-led by a Johns Hopkins University computer scientist has leveled the playing field by creating a cloud-based platform that grants genomics researchers easy access to one of the world\'s largest genomics databases.\r\n\r\nKnown as AnVIL (Genomic Data Science Analysis, Visualization, and Informatics Lab-space), the new platform gives any researcher with an Internet connection access to thousands of analysis tools, patient records, and more than 300,000 genomes. The work, a project of the National Human Genome Institute (NHGRI), appears today in Cell Genomics.\r\n\r\n\"AnVIL is inverting the model of genomics data sharing, offering unprecedented new opportunities for science by connecting researchers and datasets in new ways and promising to enable exciting new discoveries,\" said project co-leader Michael Schatz, Bloomberg Distinguished Professor of Computer Science and Biology at Johns Hopkins.\r\n\r\nTypically genomic analysis starts with researchers downloading massive amounts of data from centralized warehouses to their own data centers, a process that is not only time-consuming, inefficient, and expensive, but also makes collaborating with researchers at other institutions difficult.\r\n\r\n\"AnVIL will be transformative for institutions of all sizes, especially smaller institutions that don\'t have the resources to build their own data centers. It is our hope that AnVIL levels the playing field, so that everyone has equal access to make discoveries,\" Schatz said.\r\n\r\nGenetic risk factors for ailments such as cancer or cardiovascular disease are often very subtle, requiring researchers to analyze thousands of patients\' genomes to discover new associations. The raw data for a single human genome comprises about 40GB, so downloading thousands of genomes can take takes several days to several weeks: A single genome requires about 10 DVDs worth of data, so transferring thousands means moving \"tens of thousands of DVDs worth of data,\" Schatz said.\r\n\r\nIn addition, many studies require integrating data collected at multiple institutions, which means each institution must download its own copy while ensuring that patient-data security is maintained. This challenge is expected to become even greater in the future, as researchers embark on ever-larger studies requiring the analysis of hundreds of thousands to millions of genomes at once.\r\n\r\n\"Connecting to AnVIL remotely eliminates the need for these massive downloads and saves on the overhead,\" Schatz says. \"Instead of painfully moving data to researchers, we allow researchers to effortlessly move to the data in the cloud. It also makes sharing datasets much easier so that data can be connected in new ways to find new associations, and it simplifies a lot of computing issues, like providing strong encryption and privacy for patient datasets.\"\r\n\r\nAnVIL also provides researchers with several major analysis tools, including Galaxy, developed in part at Johns Hopkins, along with other popular tools such as R/Bioconductor, Jupyter notebooks, WDLs, Gen3, and Dockstore to support both interactive analysis and large-scale batch computing. Collectively, these tools allow researchers to tackle even the largest studies without having to build out their own computing environments.\r\n\r\nResearchers from all over the world currently use the platform to study a variety of genetic diseases, including autism spectrum disorders, cardiovascular disease, and epilepsy. Schatz\'s team, part of the Telomere-to-Telomere Consortium, used it to reanalyze thousands of human genomes with the new reference genome to discover more than 1 million new variants.\r\n\r\nAlready, the AnVIL team has collected petabytes of data from several of the largest NHGRI projects, including hundreds of thousands of genomes from the Genotype-Tissue Expression (GTEx), Centers for Mendelian Genetics (CMG), and Centers for Common Disease Genomics (CCDG) projects, with plans to host many more projects in the near future.\r\n\r\nThe AnVIL team includes researchers from Johns Hopkins University, the Broad Institute of MIT and Harvard, Harvard University, Vanderbilt University, the University of Chicago, Oregon Health and Sciences University, Yale University School of Medicine, the University of California, Santa Cruz, Roswell Park Comprehensive Cancer Institute, the Pennsylvania State University, the City University of New York, the Carnegie Institute, and Washington University in St. Louis.\r\n\r\nThis work was supported through cooperative agreement awards from NHGRI, with co-funding from the National Institute of Health\'s Office of Data Science Strategy to the Broad Institute and Johns Hopkins University.\r\n\r\nStory Source:\r\n\r\nMaterials provided by Johns Hopkins University. Original written by Lisa Ercolano. Note: Content may be edited for style and length.', 1, 1, '2022-02-08 14:13:58'),
(23, 'retest', 9, 1, '2022-02-10 05:15:01'),
(20, 'test from profile', 1, 1, '2022-02-10 05:09:10'),
(21, 'test from index', 1, 1, '2022-02-10 05:09:52'),
(22, 'test from articles', 4, 1, '2022-02-10 05:14:29'),
(19, 'test from profile', 1, 1, '2022-02-10 05:08:39');

-- --------------------------------------------------------

--
-- Struttura della tabella `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `categories`
--

INSERT INTO `categories` (`id`, `nom`) VALUES
(1, 'science'),
(2, 'music'),
(3, 'arts');

-- --------------------------------------------------------

--
-- Struttura della tabella `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `commentaire` varchar(1024) NOT NULL,
  `id_article` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `commentaires`
--

INSERT INTO `commentaires` (`id`, `commentaire`, `id_article`, `id_utilisateur`, `date`) VALUES
(1, 'i don\'t understand your points of views, i disagree', 1, 12, '2022-01-28 14:06:59'),
(2, 'just another comments ', 2, 12, '2022-01-28 14:06:59'),
(3, 'ok nice', 9, 4, '2022-02-08 06:10:57'),
(5, 'test another comment on another article test number 1', 8, 4, '2022-02-07 06:11:27'),
(6, 'tryme', 9, 1, '2022-02-07 06:16:33'),
(7, 'test third comments on the same article btw superinteresting person!', 9, 1, '2022-02-07 06:16:33'),
(12, 'test', 32, 0, '2022-02-10 10:08:42'),
(13, 'test', 32, 0, '2022-02-10 10:09:16'),
(14, 'test', 32, 0, '2022-02-10 10:09:22');

-- --------------------------------------------------------

--
-- Struttura della tabella `droits`
--

DROP TABLE IF EXISTS `droits`;
CREATE TABLE IF NOT EXISTS `droits` (
  `id` int(11) NOT NULL,
  `nom` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `droits`
--

INSERT INTO `droits` (`id`, `nom`) VALUES
(1, 'utilisateur'),
(42, 'moderateur'),
(1337, 'administrateur');

-- --------------------------------------------------------

--
-- Struttura della tabella `pictures`
--

DROP TABLE IF EXISTS `pictures`;
CREATE TABLE IF NOT EXISTS `pictures` (
  `id_article` int(11) NOT NULL,
  `link` varchar(50) NOT NULL,
  `id_utilisateur` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `pictures`
--

INSERT INTO `pictures` (`id_article`, `link`, `id_utilisateur`) VALUES
(1, '/public/pictures/lithium.webp', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_droits` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `password`, `email`, `id_droits`) VALUES
(1, 'nami2', '1234', 'nami2@nami2.io', 1337),
(4, 'adminz', '1234', 'adminz@adminz.io', 1337),
(9, 'mina', '1234', 'mina@mina.io', 42);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
