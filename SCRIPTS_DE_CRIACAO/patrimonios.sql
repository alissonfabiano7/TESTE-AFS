CREATE TABLE `patrimonios` (
  `id` int NOT NULL,
  `date` datetime DEFAULT NULL,
  `fundo_id` int NOT NULL,
  `value` int NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `_idx` (`fundo_id`),
  CONSTRAINT `` FOREIGN KEY (`fundo_id`) REFERENCES `fundos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)

