
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `zf_blog`
--

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` VALUES(1, 'Fantastico!', 'A fantastic post in a fantastic blog.\r\n\r\nI''m not a spammer by the way!', 'roy@kartaca.com', 'Roy Simkes', 1, '2010-09-27 15:54:16', NULL);
INSERT INTO `comments` VALUES(2, 'Yet Another Wonderful Lipsum Implementation', 'Lorem Ipsum, yet again, sit amet...', 'roy@kartaca.com', 'Roy Simkes', 1, '2010-09-27 17:02:41', '2010-09-27 17:02:41');

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` VALUES(1, 'Lorem Ipsum', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut aliquam, dolor vel blandit auctor, nibh sapien pharetra est, nec ultricies arcu nibh venenatis urna. Maecenas fermentum neque ut neque semper semper. Fusce et orci vel odio rhoncus molestie ornare ut lectus. Pellentesque interdum interdum eros sit amet ullamcorper. Quisque fermentum dui a justo ultricies eleifend. Duis dui nunc, dictum eu iaculis at, pulvinar in urna. Morbi consequat condimentum lacus, a posuere dui iaculis ac. Curabitur et turpis vel leo vulputate fermentum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vestibulum est massa, euismod vitae facilisis et, pellentesque id ligula. Ut imperdiet ipsum eget purus dignissim tincidunt. Proin quis velit nulla. Donec auctor, purus in dictum bibendum, risus elit consectetur arcu, in viverra orci nisi vel quam. Cras ornare consequat volutpat. Donec porttitor lectus id enim feugiat posuere. Aliquam quis nisi ac turpis pretium rutrum. Ut eget dui odio. Etiam vitae diam vitae libero malesuada porta ut egestas ligula. Aliquam a ligula vel dui vulputate ornare sit amet a ante. Suspendisse urna diam, euismod quis varius eget, viverra eu lacus. \r\n\r\nAliquam eu magna est. Aenean commodo purus eget felis ullamcorper sed egestas justo sagittis. Duis lacus nisl, accumsan vel sodales vitae, adipiscing a lacus. Phasellus sit amet justo vel magna suscipit semper. In tortor nulla, molestie et convallis eu, pellentesque non dui. Nam dapibus dapibus vestibulum. Proin facilisis, mauris sed iaculis viverra, est tortor iaculis dui, quis ultrices tortor risus id urna. Duis at arcu quam. Fusce scelerisque urna nec diam congue feugiat. Vivamus hendrerit augue id magna venenatis ultrices. Cras ornare mi at lectus venenatis congue. Nullam ut ligula in diam dapibus cursus. Nullam adipiscing eleifend interdum. Duis at mi odio, sed vulputate libero. Donec accumsan gravida neque, vel tempus leo molestie in. Praesent vel metus nisi. Praesent posuere volutpat tellus, tempor consectetur orci scelerisque eget. Quisque at hendrerit massa. \r\n\r\nDonec aliquet consectetur consectetur. Aliquam elementum rutrum felis sed sagittis. Vestibulum mattis eros quis tortor aliquam id malesuada nisi iaculis. Donec consequat pellentesque felis, sollicitudin iaculis tortor elementum vitae. Phasellus dapibus libero et lorem laoreet placerat ultrices leo placerat. In hac habitasse platea dictumst. Donec tortor enim, varius eu lobortis at, lacinia ac enim. Nunc auctor accumsan magna, at ullamcorper lorem molestie sit amet. Nunc imperdiet quam eleifend sapien sagittis interdum. Sed vel arcu est, nec eleifend nisl. Donec vitae dui nisl. Sed placerat mi at arcu iaculis varius. Morbi vestibulum gravida viverra. Quisque sagittis, lorem et sollicitudin accumsan, magna quam tincidunt neque, at pellentesque turpis nisi id nibh.', 'lipsum', 1, '2010-09-27 16:50:18');
INSERT INTO `posts` VALUES(2, 'No more Lipsum For You', 'As I told you, no more lipsum. No more sit ameth too!', 'say-no-to-lipsum', 1, NULL);

--
-- Dumping data for table `users`
--

INSERT INTO `users` VALUES(1, 'roy', '356a192b7913b04c54574d18c28d46e6395428ab', 1);
