--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerID`, `username`, `password_hash`, `customer_forename`, `customer_surname`, `customer_postcode`, `customer_address1`, `customer_address2`, `date_of_birth`) VALUES
(1, 'fred@fred.com', '1F3870BE274F6C49B3E31A0C6728957F', 'Fred', 'Brown', 'NE11 8JH', '1 Test Street', 'Newcastle upon Tyne', '1985-11-13 00:00:00');

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movieID`, `movie_name`, `description`, `ticket_price`, `rating`, `img_path`, `director`, `duration`) 
VALUES
(1, 
'Tears of Steel',
'Thom just wanted to be an astronaut. His girlfriend Celia just wanted to create robots - and for him to not be freaked out by her cyborg hand. How was Thom supposed to know that breaking up with her would make her take out her anger on the rest of humanity using her robots? It seems the only possible way of undoing everything...is to overwrite her memory of what happened 40 years ago.', 
8.50, 
'15',
'tears_of_steel.png',
'Ian Hubert',
'1hr 50mins'), 
(2, 
'The Unknown', 
'The men in black would be out of their depth here. Brave men and women depart earth to discover a new frontier for human kind. Only to find out they are not welcome. Will the heros have what it takes to fight the unspeakable horrors that they find, and can they survive long enough to send earth warning of the incoming threat.', 
6.50,
'PG',
'unknown.png',
'Tom McGrath',
'2hrs 10mins'),
(3, 
'Space Tourists', 
'Space Tourists succeeds in surprising its audience with images and situations that have very little to do with the futuristic fantasy of space-tourism. The filmmaker sets up encounters with the least likely people imaginable: places even stranger and more unknown than outer space itself. With extra-ordinary access and truly first-time images the film investigates the emotional oscillations of an expensive enterprise and questions the meaning and boundaries of the human spirit and our hunger for adventure and discovery.', 
6.50,
'PG',
'space_tourists.png',
'Christopher Frei',
'2hrs 15mins'),
(4, 
'Amsel', 
'Illustrator of the lost art Amsel. An amazing story about one mans quest to unlock his potential and find meaning in what was otherwise a meaningless life. Love, laughter and tears will be shed at this incredible film.', 
6.50,
'15',
'Amsel.jpg',
'Adam McDaniel',
'1hrs 30mins'),
(5, 
'Houston We Have a Problem', 
'The cold war, the space race, and NASAs moon landing are iconic events that defined an era. They are also fodder for conspiracy theories. In Houston, We Have a Problem! filmmaker Ziga Virc explores the myth of a secret multi-billion-dollar deal involving Americas purchase of Yugoslavias space program in the early 1960s. This masterfully crafted feature-length docu-fiction is an intriguing blend of reality and fiction that recreates recent history through the prism of conspiracy theories.', 
5.50,
'PG',
'Houston_We_Have_a_Problem',
'Ziga Virc',
'1hrs 30mins'),
(6, 
'Hidden Universe', 
'An extraordinary journey deep into space, the documentary adventure Hidden Universe brings to life the farthest reaches of our universe with unprecedented clarity through real images captured by the worlds most powerful telescopes-seen on-screen and in 3D for the first time', 
5.50,
'12',
'Hidden_Universe.jpg',
'Russel Scott',
'1hrs 45mins'),
(7, 
'The Endless Summer', 
'They call it The Endless Summer the ultimate surfing adventure, crossing the globe in search of the perfect wave. From the uncharted waters of West Africa, to the shark-filled seas of Australia, to the tropical paradise of Tahiti and beyond, these California surfers accomplish in a few months what most people never do in a lifetime...They live their dream.', 
8.50,
'PG',
'Hidden_Universe.jpg',
'Bruce Brown',
'1hrs 45mins'),
(8, 
'Abducted', 
'An inner-city teenage boys life is turned upside-down when his drug-running sister goes missing. Lakotas sudden disappearance leaves Derrick to piece together the clues of her abduction. Derrick experiences visions which he struggles to understand but which help him on his quest to find her. As he gets close to finding his sister, Derrick ends up in the fight of his life.', 
7.50,
'15',
'Abducted.jpg',
'Daniel Foreman',
'1hrs 45mins'),
(9, 
'Nocturne In Black', 
'In a war-ravaged Middle Eastern neighborhood, a musician struggles to rebuild his piano after it is destroyed by terrorists. Find out what happens when he is confronted with his inner demons.', 
8.50,
'18',
'Nocturne_in_black.jpg',
'Jimmy Keyrouz',
'1hrs 45mins'),
(10, 
'Memento', 
'Memento chronicles two separate stories of Leonard, an ex-insurance investigator who can no longer build new memories, as he attempts to find the murderer of his wife, which is the last thing he remembers. One story line moves forward in time while the other tells the story backwards revealing more each time.', 
9.50,
'12',
'Momento.jpg',
'Christopher Nolan',
'1hrs 45mins');

--
-- Dumping data for table `movie_bookings`
--

INSERT INTO `movie_bookings` (`movieID`, `customerID`, `screening_date_time`, `num_attending`) VALUES
(1, 1, '2021-07-11 14:30:00', 3);
