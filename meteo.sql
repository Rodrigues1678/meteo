CREATE TABLE IF NOT EXISTS `meteo` (
  `jour` date NOT NULL,
  `ville` varchar(50) NOT NULL,
  `periode` varchar(50) NOT NULL,
  `resume` varchar(50) NOT NULL,
  `id_resume` int(11) NOT NULL,
  `temp_min` int(11) NOT NULL,
  `temp_max` int(11) NOT NULL,
  `commentaire` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;