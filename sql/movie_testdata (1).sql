--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`customerID`, `username`, `password_hash`, `customer_forename`, `customer_surname`, `customer_postcode`, `customer_address1`, `customer_address2`, `date_of_birth`) VALUES
(1, 'fred@fred.com', '1F3870BE274F6C49B3E31A0C6728957F', 'Fred', 'Brown', 'NE11 8JH', '1 Test Street', 'Newcastle upon Tyne', '1985-11-13 00:00:00');

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movieID`, `movie_name`, `description`, `ticket_price`, `rating`) VALUES
(1, 'The Shawshank Redemption', 'Chronicles the experiences of a formerly successful banker as a prisoner in the gloomy jailhouse of Shawshank after being found guilty of a crime he did not commit. The film portrays the man\'s unique way of dealing with his new, torturous life; along the way he befriends a number of fellow prisoners, most notably a wise long-term inmate named Red.', '8.50', '15'),
(2, 'Boss Baby: Family Business', 'If your kids are fans of the first Boss Baby movie, they\'ll be happy to know there\'s another bundle on the way. This time, Tim and Ted are grown-ups who — at the behest of Tim\'s infant daughter — have to turn back into babies to help stop an evil villain. ', '6.50', 'PG');

--
-- Dumping data for table `movie_bookings`
--

INSERT INTO `movie_bookings` (`movieID`, `customerID`, `screening_date_time`, `num_attending`) VALUES
(1, 1, '2021-07-11 14:30:00', 3);
