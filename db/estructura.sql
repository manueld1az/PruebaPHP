CREATE SCHEMA `prueba` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `prueba`;

CREATE TABLE `clases` (
  `codigo_clase` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre_clase` varchar(30) NOT NULL,
  PRIMARY KEY (`codigo_clase`)
);

CREATE TABLE `familias` (
  `codigo_familia` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre_familia` varchar(30) NOT NULL,
  PRIMARY KEY (`codigo_familia`)
);

CREATE TABLE `segmentos` (
  `codigo_segmento` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre_segmento` varchar(30) NOT NULL,
  PRIMARY KEY (`codigo_segmento`)
);

CREATE TABLE `productos` (
  `codigo_producto` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre_producto` varchar(30) NOT NULL,
  `segmento` bigint unsigned NOT NULL,
  `familia` bigint unsigned NOT NULL,
  `clase` bigint unsigned NOT NULL,
  PRIMARY KEY (`codigo_producto`),
  CONSTRAINT `productos_clase_foreign` FOREIGN KEY (`clase`) REFERENCES `clases` (`codigo_clase`),
  CONSTRAINT `productos_familia_foreign` FOREIGN KEY (`familia`) REFERENCES `familias` (`codigo_familia`),
  CONSTRAINT `productos_segmento_foreign` FOREIGN KEY (`segmento`) REFERENCES `segmentos` (`codigo_segmento`)
);

CREATE TABLE `responsables` (
  `codigo_responsable` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(30) NOT NULL,
  `numero_telefono` varchar(30) NOT NULL,
  `correo_electronico` varchar(30) NOT NULL,
  PRIMARY KEY (`codigo_responsable`)
);

CREATE TABLE `procesos` (
  `codigo_proceso` bigint unsigned NOT NULL AUTO_INCREMENT,
  `objeto` VARCHAR(30) NOT NULL,
  `actividad` VARCHAR(50),
  `estado` VARCHAR(20),
  `responsable` bigint,
  `presupuesto` int NOT NULL,
  `moneda` VARCHAR(5) NOT NULL,
  `descripcion` text NOT NULL,
  `fecha_inicio` date NOT NULL,
  `hora_inicio` time NOT NULL,
  `fecha_cierre` date NOT NULL,
  `hora_cierre` time NOT NULL,
  PRIMARY KEY (`codigo_proceso`)
  -- NO PUEDE SER LLAVE FORÁNEA AUN PORQUE NO PERMITIRÍA CREAR PROCESOS HASTA QUE ALLÁ RESPONSABLES
  -- CONSTRAINT `procesos_responsable_foreign` FOREIGN KEY (`responsable`) REFERENCES `responsables` (`codigo_responsable`)
);

CREATE TABLE `compradores` (
  `codigo_comprador` bigint unsigned NOT NULL AUTO_INCREMENT,
  `nombre_completo` varchar(30) NOT NULL,
  `numero_telefono` varchar(30) NOT NULL,
  `correo_electronico` varchar(30) NOT NULL,
  PRIMARY KEY (`codigo_comprador`)
);

CREATE TABLE `ofertas` (
  `codigo_oferta` bigint unsigned NOT NULL AUTO_INCREMENT,
  `comprador` bigint unsigned NOT NULL,
  `proceso` bigint unsigned NOT NULL,
  PRIMARY KEY (`codigo_oferta`),
  CONSTRAINT `ofertas_comprador_foreign` FOREIGN KEY (`comprador`) REFERENCES `compradores` (`codigo_comprador`),
  CONSTRAINT `ofertas_proceso_foreign` FOREIGN KEY (`proceso`) REFERENCES `procesos` (`codigo_proceso`)
);