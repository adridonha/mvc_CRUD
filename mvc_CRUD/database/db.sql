-- Create the database
CREATE DATABASE dwes DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;USE dwes;

-- Create the tables
CREATE TABLE store (cod INT NOT NULL AUTO_INCREMENT PRIMARY KEY,name VARCHAR(100) NOT NULL,tlf VARCHAR(13) NULL)ENGINE=INNODB;

CREATE TABLE product (cod VARCHAR(12) NOT NULL,name VARCHAR(200) NULL,short_name VARCHAR(50) NOT NULL,description TEXT NULL,RRP DECIMAL(10,2) NOT NULL,family VARCHAR(6) NOT NULL, PRIMARY KEY( cod ), INDEX( family ), UNIQUE( short_name ))ENGINE=INNODB;

CREATE TABLE family (cod VARCHAR(6)NOT NULL, name VARCHAR(200)NOT NULL,PRIMARY KEY( cod ))ENGINE=INNODB;

CREATE TABLE stock (product VARCHAR(12)NOT NULL,store INT NOT NULL,units INT NOT NULL,PRIMARY KEY( product , store ))ENGINE=INNODB;

-- We create the foreign keys
ALTER TABLE product ADD CONSTRAINT product_ibfk_1 FOREIGN KEY(family) REFERENCES family (cod) ON UPDATE CASCADE;

ALTER TABLE stock ADD CONSTRAINT stock_ibfk_2 FOREIGN KEY(store) REFERENCES store (cod) ON UPDATE CASCADE, ADD CONSTRAINT stock_ibfk_1 FOREIGN KEY(product) REFERENCES product (cod) ON UPDATE CASCADE;


USE dwes;

INSERT INTO store (cod, name, tlf) VALUES
(1, 'HEAD OFFICE', '600100100'),
(2, 'BRANCH1', '600100200'),
(3, 'BRANCH2', NULL);

INSERT INTO family (cod, name) VALUES
('CAMERA', 'Digital cameras'),
('CONSOL', 'Consoles'),
('EBOOK', 'Electronic books'),
('IMPRES', 'Printers'),
('MEMFLA', 'Flash drives'),
('MP3', 'MP3 players'),
('MULTIF', 'Multifunction equipment'),
('NETBOK', 'Netbooks'),
('COMPU', 'Computers'),
('PORTAT', 'Portable computers'),
('ROUTER', 'Routers'),
('UPS', 'Uninterruptible Power Supply'),
('SOFTWA', 'Software'),
('TV', 'TV sets'),
('VIDEOC', 'Camcorders');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('3DSNG', NULL, 'Nintendo 3DS black', 'Nintendo handheld console that will allow to enjoy 3D effects without special glasses, and will include backward compatibility with DS and DSi software.', '270.00', 'CONSOL');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('ACERAX3950', NULL, 'Acer AX3950 I5-650 4GB 1TB W7HP', 'Features:Operating System: Windows® 7 Home Premium Original Processor / Chipset Number of PCI Slots: 1 Processor Manufacturer: Intel Processor Type: Core i5 Processor Model: i5-650 Processor Core: Dual-core Processor Speed: 3.20 GHzCache: 4 MB Bus Speed: Not applicableHyperTransport Speed: Not applicableQuickPath InterconnectNot applicable64-bit processing: YesHyper-ThreadingYesChipset Manufacturer: IntelChipset Model: H57 ExpressMemoryStandard Memory: 4 GBMax Memory: 8 GBMemory Technology: DDR3 SDRAM Memory Standard: DDR3-1333/PC3-10600 Number of Memory Slots (Total): 4 Memory Card Reader: Yes Memory Card Holder: CompactFlash Card (CF) Memory Card Holder: MultiMediaCard (MMC) Memory Card Holder: Micro Drive Memory Card Holder: Memory Stick PRO Memory Card Holder: Memory Stick Memory Card Holder: CF+ Memory Card Holder: Secure Digital (SD) Card: 1 TBHard Disk Drive RPM: 5400 Optical Drive Type: DVD Recorder Optical Device Compatibility: DVD-RAM/±R/±RW Dual Layer Media Compatibility: Yes', '410.00', 'COMPU');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('ARCLPMP32GBN', NULL, 'Archos Clipper MP3 2GB black', 'Features:Internal Storage Available in 2GB Windows or Mac and Linux compatibility (with support for mass storage)Interface for computer USB 2. 0 high-speed battery life2 11 hours music Playback Music3 MP3 Dimensions Dimensions: 52mm x 27mm x 12mm, Weight: 14 Gr', '26.70', 'MP3');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('BRAVIA2BX400', NULL, 'Sony Bravia 32IN FULLHD KDL-32BX400', 'Features:Full HD: Watch sports movies and games with superb detail in high resolution thanks to 1920x1080 resolution.HDMI®: 4 inputs (3 on the back, 1 on the side)USB Media Player: Enjoy movies, photos and music on your TV. \Integrated MPEG-4 AVC HD TV tuner: Forget the encoder and access TV services including HD channels with the integrated DVB-T and DVB-C tuner with MPEG4 AVC decoder (depending on country and only with compatible operators) Light sensor: Automatically adjusts brightness according to the level of ambient lighting so you can enjoy optimal picture quality without unnecessary power consumption. \BRAVIA Sync: Control your entire home entertainment system with a single universal remote control that allows you to play content or adjust the settings of compatible devices with a single button. BRAVIA ENGINE 2: Experience incredibly crisp, sharp colors and picture details. \Live Colour™: Select from four modes - off, low, medium and high - to adjust color for vivid images and optimal picture quality. \r24p True Cinema™: reproduce an authentic cinematic experience and enjoy movies exactly as the director intended at 24 frames per second.', '356.90', 'TV');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('EEEPC1005PXD', NULL, 'Asus EEEPC 1005PXD N455 1 250 BL', 'Features:\r\nProcessor: 1660 MHz, N455, Intel Atom, 0.5 MB. \Memory: 1024 MB, 2 GB, DDR3, SO-DIMM, 1 x 1024 MB. \Disk drive: 2.5", 250 GB, 5400 RPM, Serial ATA, Serial ATA II, 250 GB. \Storage media: MMC, SD, SDHC. \Display: 10.1 ", 1024 x 600 Pixels, TFT LCD. \Camera: 0.3 MP. \Network: 802.11 b/g/n, 10, 100 Mbit/s, Fast Ethernet. \Audio: HD. \Operating system/software: Windows 7 Starter. \Color: White. \Power control: 8 MB/s, Lithium-Ion, 6 pieces, 2200 mAh, 48 W. \Weight and dimensions: 1270 g, 178 mm, 262 mm, 25.9 mm, 36.5 mm', '245.40', 'NETBOK');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('HPMIN1103120', NULL, 'HP Mini 110-3120 10. 1LED N455 1GB 250GB W7S black', 'Features: \Installed operating system Windows® 7 Starter original 32-bit Windows® 7 Starter 32-bit Processor Intel® Atom™ Processor N4551,66 GHz, Level 2 Cache,512 KB Intel® NM10 + ICH8m chipset 1 GB (1 x 1024 MB) DDR2 memory (1 x 1024 MB) Maximum memory supports up to 2 GB of DDR2 memory Memory slots 1 user-accessible memory slot1 user-accessible memory slot Internal drives 250 GB SATA hard drive (5400 rpm) Graphics Screen size (diagonal) 25, 6 cm (10.1") diagonal Display resolution 1024 x 600', '270.00', 'NETBOK');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('IXUS115HSAZ', NULL, 'Canon Ixus 115HS blue', 'Features:HS System (12.1 MP) 4x zoom, 28 mm.Optical IS Stylized metal body 7.6 cm (3.0") PureColor II G LCD 7.6 cm (3.0") Full HD.Dynamic IS.HDMI Smart Auto Mode (32 scenes) ', '196.70', 'CAMERA');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('KSTDT101G2', NULL, 'Kingston DataTraveler 16GB DT101G2 USB2.0 black', 'Features:\r\nCapacities - 16GBDimensions - 2.19" x 0.68" x 0.36" (55.65mm x 17.3mm x 9.05mm)Operating Temperature - 0° to 60° C / 32° to 140° F Storage Temperature - -20° to 85° C / -4° to 185° F Simple - Just plug it into a USB port and its ready to use. Practical - No twist-off cap design protects the USB connector; no cap to lose - Five-year warranty', '19.20', 'MEMFLA');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('KSTDTG332GBR', NULL, 'Kingston DataTraveler G3 32GB red', 'Features:Product type USB flash drive Storage capacity 32GB Width 58. 3 mmDepth 23.6 mmHeight 9.0 mmWeight 12 gIncluded color RED', '40.00', 'MEMFLA');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('KSTMSDHC8GB', NULL, 'Kingston MicroSDHC 8GB', 'Kingston flash memory card 8GB microSDHC 8GB Speed Rating Class 4 Storage Capacity 8GB Form Factor MicroSDHC Memory Adapter Included microSDHC to SD Adapter Manufacturers Warranty Limited Lifetime Warranty', '10.20', 'MEMFLA');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('LEGRIAFS306', NULL, 'Canon Legria FS306 silver', 'Features:
\SD/SDHC memory card recording \r "The smallest Canon digital camcorder ever seen \r "Instant Video Snapshot (Video Snapshot) \r "Advanced 41x Zoom \r "Dual Shot (Dual Shot) \r "Image Stabilizer with Dynamic Mode \r "Pre Recording (Pre REC) \r "System 16: 9 high resolution truly panoramic \r "Smart Battery and Fast Charge \r "Compatible with DVD recorder DW-100 \r "Video System \r "Recording Support: Removable memory card (SD / SDHC) \r "Maximum recording time: Variable, depending on the size of the memory card. \32 GB SDHC card: 20 hours 50 minutes', '175.00', 'VIDEOC');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('LGM237WDP', NULL, 'LG TDT HD 23 M237WDP-PC FULL HD', 'Features:Size (inches): 23 "LCD Display: Yes Format: 16:9 "Resolution: 1920 x 1080 "Full HD: Yes "Brightness (cd/m2): 300 "Contrast Ratio: 50. 000:1 Response Time (ms): 5 Angle of View (°): 170 Number of Colors (Millions): 16.7 "DTT: TDT HDTV Connections: YesDVI-D: YesHDMI: YesEuroconnector: YesHeadphone output: Yes Audio input: Yes USB Service: Yes RS-232C Service: Yes PCMCIA: Yes Optical output: Yes', '186.00', 'TV');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('LJPROP1102W', NULL, 'HP Laserjet Pro Wifi P1102W', 'Laserjet P1102W printer is easy to install and use, plus it will help you save energy and resources.  Forget about cables and enjoy the freedom of WIFI technology, print easily from anywhere in your office. Maximum format accepted A4 A2 No A3 NoA4 YesA5 YesA6 SB5 YesB6 Yes C5 Envelopes (162 x 229 mm) YesC6 Envelopes (114 x 162 mm) Yes', '99.90', 'IMPRES');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('OPTIOLS1100', NULL, 'Pentax Optio LS1100', 'The LS1100 with carrying case and 2GB memory card included is the digital compact you will take everywhere. This camera designed by Pentax incorporates a 14.1 megapixel CCD sensor and a 28 mm wide-angle lens.', '104.80', 'CAMERA');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('PAPYRE62GB', NULL, 'Lector ebooks Papyre6 con SD2GB + 500 ebooks', 'Papyre brand Papyre 6. 1 \r "Use eBook Reader e-ink technology (e-ink, Vizplez) \r "CPU Samsung Am9 200MHz \r "Memory - Internal: 512MB - External:  SD/SDHC up to 32GB \r\r\nFormats PDF, RTF, TXT, DOC, HTML, MP3, CHM, ZIP, FB2, Image formats \r\nDisplay 6" (600x800px), black and white, 4 gray levels ', '205.50', 'EBOOK');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('PBELLI810323', NULL, 'Packard Bell I8103 23 I3-550 4G 640GB NVIDIAG210', 'Features:CPU CHIPSETProcessor : Ci3-550NorthBridge : Intel H57MEMORY Rma Memory : Ddr3 4096 MBSTORAGE DEVICESHard Drive: 640Gb 7200 rpmOptical : Slot Load siper multi DvdrwCard Reader : 4 in 1 (XD, SD, HC, MS, MS, MS PRO, MMC)Graphics DevicesMonitor : 23 fHDGraphic Card : Nvidia G210M D3 512Mb Maximum Memory : Up to 1918MbAUDIOAudio Out: 5. 1 Audio OutAudio In: 1 jackHeasphone in: 1x jackSpeakers: StereoACCESSORIESKeyboard: Wireless keyboard and mouseRemote control: EMEA Win7 WMCCOMMUNICATIONSWireless: 802. 11 b/g/n mini cardNetwork Card: 10/100/1000 MbpsBluetooth: BluethootWebcam: 1Mpixel Hd (1280x720)Tv tuner: mCARD/SW/ DVB-TMONIT Size: 23 "Contrast: 1000:1Response time: 5MSResolution: 1920 X 1080PORTS E/SUsb 2. 0 : 6Mini Pci-e : 2Esata: 1Operating System: Microsoft Windows 7 Premium', '761.80', 'COMPU');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('PIXMAIP4850', NULL, 'Canon Pixma IP4850', 'Features:Type: separate inkjet cartridgesConnection: Hi-Speed USBDirect print port from camerasMaximum resolution: 9600x2400 dpiPrint speed: 11 ipm (black) / 9.3 ipm (color)Maximum paper size: A4Input tray: 150 sheetsDimensions: 43.1 cm x 29.7 cm x 15.3 cm', '97.30', 'IMPRES');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('PIXMAMP252', NULL, 'Canon Pixma MP252', 'Features:Functions:
Printer, Scanner , CopierConnection:USB 2.0Dimensions:444 x 331 x 155 mmWeight: 5.8 KgPRINTMaximum resolution: 4800 x 1200 dpiPrint speed:Black/color: 7.0 ipm / 4.8 ipmMaximum paper size: A4CARTRIDGESBlack: PG-510 / PG-512Color: CL-511 / CL-513SCANNERMaximum resolution: 600 x 1200 dpi (digital: 19200 x 19200)Color depth: 48/24 bitMaximum scanning area: A4COPIAT 1st copy out time: approx. 39 sec.', '41.60', 'MULTIF');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('PS3320GB', NULL, 'PS3 with 320GB hard drive', 'This Pack Includes:- Playstation 3 Slim Black 320GB console- Killzone 3 game', '380.00', 'CONSOL');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('PWSHTA3100PT', NULL, 'Canon Powershot A3100 silver', 'The smart, compact PowerShot A3100 IS camera features Canon image quality in a compact, lightweight body for effortless photo capture; it s as easy as point and shoot.Features:12.1 MP 4x optical zoom with IS 6.7 cm (2.7") LCD screen', '101.40', 'CAMERA');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('SMSGCLX3175', NULL, 'Samsung CLX3175', 'Features:Function:
Color printing, copier, ScannerPrint Speed (Mono)Up to 16 ppm in A4 (17 ppm in Letter)Speed (Color)Up to 4 ppm in A4 (4 ppm in Letter)First Page Out (Mono)Less than 14 seconds (From Ready Mode)ResolutionUp to 2400 x 600 dpi effective outputFirst Page Out (Color)Less than 26 seconds (From Ready Mode)DuplexManualEmulationSPL- C (SAMSUNG Print Color Language)Copy First Page Out (Mono)18 secondsMulticopy1 ~ 99Zoom25 ~ 400 %Copy FunctionsCopy ID, Clone Copy, N-UP Copy, Copy PosterResolutionText, Text / Photo, Magazine Mode: Up to 600 x 600 dpi, Photo Mode: Up to 1200 x 1200 dpiSpeed (Mono)Up to 17 ppm in Letter (16 ppm in A4)Speed (Color)Up to 4 ppm in Letter (4 ppm in A4 )First Page Out (Color)45 secondsScanning CompatibilityTWAIN Standard, WIA Standard (Windows2003 / XP / Vista)MethodColor Flatbed ScannerResolution (Optical)1200 x 1200 dpiResolution (Enhanced)4800 x 4800 dpiScan to Scan to USB / Folder', '190.00', 'MULTIF');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('SMSN150101LD', NULL, 'Samsung N150 10.1LED N450 1GB 250GB BAT6 BT W7 R', 'Features:Operating System Genuine Windows® 7 Starter Intel® ATOM Processor N450 (1.66GHz, 667MHz, 512KB) Intel® NM10 ChipsetSystem Memory 1GB (DDR2 / 1GB x 1) Memory Slot 1 x SODIMM LCD Display 10. 1" WSVGA (1024 x 600), Non-Gloss, LED Back Light Graphics Intel® GMA 3150 DVMT Graphics Processor Graphics Memory Shared Memory (Int. Grahpic) Multimedia HD Sound (High Definition) Audio Sound Features SRS 3D Sound Effect Speakers 3W Stereo Speakers (1. 5W x 2) Integrated Camera Web Camera Storage Hard Disk 250GB SATA (5400 rpm S-ATA) ConnectivityWired Ethernet LAN (RJ45) 10/100 LAN Wireless LAN 802.11 b/g/NBluetooth Bluetooth Bluetooth 3.0 High Speed I/O Port VGA Headphone-outMic-inInternal MicUSB (Chargable USB included) 3 x USB 2.0 Multi Card Slot 4-in-1 (SD, SDHC, SDXC, MMC)DC-in (Power Port)Keyboard Type 84 keys Touch Pad, Touch Screen Touch Pad (Scroll Scope, Flat Type) SecurityRecovery Samsung Recovery Solution Virus McAfee Virus Scan (trial version) Security BIOS Boot Up Password / HDD Password Lock Kensington Lock Port Battery Adapter 40 Watt Battery 6 Cell Dimensions ', '260.60', 'NETBOK');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('SMSSMXC200PB', NULL, 'Samsung SMX-C200PB EDC ZOOM 10X', 'Features:Image Sensor Type 1 / 6" 800K pixel CCDOptical Zoom Lens 10 x opticalFeatures Video Recording Image Stabilizer Hyper digital image stabilizerInterface Memory Card SDHC / SD Card Slot', '127.20', 'VIDEOC');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('STYLUSSX515W', NULL, 'Epson Stylus SX515W', 'Features:Maximum resolution5760 x 1440 DPPrint speedPrint speed (black, normal quality, A4)36 ppmPrint speed (color, normal quality, A4)36 ppmPrint technologyInkjet printing technologyNumber of print cartridges4 piecesPrinter headMicro PiezoScanningMaximum scanning resolution2400 x 2400 DPIEscan color: yes Scanning type Flatbed scannerIntegrated scanner: yesScanning technology CISWLAN, connection: yes', '77.50', 'MULTIF');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('TSSD16GBC10J', NULL, 'Toshiba SD16GB Class10 Jewel Case', 'Features:Density: 16 GBPINs of connection: 9 pinsInterface: Standard SD memory card compatibleWrite Speed: 20 MBytes/s*Read Speed: 20 MBytes/s*Dimensions: 32. 0 mm (L) × 24.0 mm (W) × 2.1 mm (H)Weight: 2gTemperature: -25°C to +85°C (Recommended)Humidity: 30% to 80% RH (non-condensing)', '32.60', 'MEMFLA');

INSERT INTO product (cod, name, short_name, description, RRP, family) VALUES
('ZENMP48GB300', NULL, 'Creative Zen MP4 8GB Style 300', 'Features:8GB capacityAutonomy: 32 hours with MP3 files at 128 kbps1.8-inch 64. 000 colorsSupported audio formats: MP3, WMA (DRM9), Audible 4 formatSupported photo formats: JPEG (BMP, TIFF, GIF and PNGSupported video formats: AVI transcoded (Motion JPEG)5-band equalizer with 8 presetsBuilt-in microphone for voice recordingBuilt-in speakerphone and FM radio', '58.90', 'MP3');

INSERT INTO stock (product, store, units) VALUES
('3DSNG', 1, 2),
('3DSNG', 2, 1),
('ACERAX3950', 1, 1),
('ARCLPMP32GBN', 2, 1),
('ARCLPMP32GBN', 3, 2),
('BRAVIA2BX400', 3, 1),
('EEEPC1005PXD', 1, 2),
('EEEPC1005PXD', 2, 1),
('HPMIN1103120', 2, 1),
('HPMIN1103120', 3, 2),
('IXUS115HSAZ', 2, 2),
('KSTDT101G2', 3, 1),
('KSTDTG332GBR', 2, 2),
('KSTMSDHC8GB', 1, 1),
('KSTMSDHC8GB', 2, 2),
('KSTMSDHC8GB', 3, 2),
('LEGRIAFS306', 2, 1),
('LGM237WDP', 1, 1),
('LJPROP1102W', 2, 2),
('OPTIOLS1100', 1, 3),
('OPTIOLS1100', 2, 1),
('PAPYRE62GB', 1, 2),
('PAPYRE62GB', 3, 1),
('PBELLI810323', 2, 1),
('PIXMAIP4850', 2, 1),
('PIXMAIP4850', 3, 2),
('PIXMAMP252', 2, 1),
('PS3320GB', 1, 1),
('PWSHTA3100PT', 2, 2),
('PWSHTA3100PT', 3, 2),
('SMSGCLX3175', 2, 1),
('SMSN150101LD', 3, 1),
('SMSSMXC200PB', 2, 1),
('STYLUSSX515W', 1, 1),
('TSSD16GBC10J', 3, 2),
('ZENMP48GB300', 1, 3),
('ZENMP48GB300', 2, 2),
('ZENMP48GB300', 3, 2);


