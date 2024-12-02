Here is a detailed, structured breakdown for the tables you provided. It defines relationships, attributes, actions, scopes, API queries, and other elements needed for a comprehensive model structure:

Model Definitions for the Tables

1. Accounts

	•	Relationships:
	•	hasMany purchases, belongsTo users
	•	Casts:
	•	url, sitename (string)
	•	Fillable:
	•	url, sitename, status
	•	Scopes:
	•	active() - Active accounts filter.
	•	Actions:
	•	generateReport()
	•	API Queries:
	•	filterByStatus($status)

2. Admins

	•	Relationships:
	•	hasMany users
	•	Casts:
	•	username, email (string)
	•	Fillable:
	•	username, email, password
	•	Scopes:
	•	adminsOnly()
	•	Actions:
	•	resetPassword()
	•	Notification:
	•	AdminPasswordReset

3. Banks

	•	Relationships:
	•	hasMany users
	•	Fillable:
	•	bankname, url
	•	Scopes:
	•	filterByBankName($name)
	•	Actions:
	•	addBankDetails()
	•	API Queries:
	•	getBankDetails($id)

4. Cpannels

	•	Relationships:
	•	hasOne accounts
	•	Fillable:
	•	url
	•	Scopes:
	•	activeAccounts()
	•	Actions:
	•	generateNewPanel()
	•	API Queries:
	•	getCpanelData()
	•	Searchable:
	•	url, panel_name

5. Images

	•	Relationships:
	•	hasMany tutorials
	•	Fillable:
	•	image, url
	•	Casts:
	•	image (string)
	•	Actions:
	•	resizeImage()
	•	API Queries:
	•	getImageDetails($id)

6. Leads

	•	Relationships:
	•	belongsTo campaigns
	•	Fillable:
	•	url, number, status
	•	Scopes:
	•	filterByStatus($status)
	•	Actions:
	•	captureLead()
	•	API Queries:
	•	getLeadDetails()

7. Mailers

	•	Relationships:
	•	hasMany users
	•	Fillable:
	•	url
	•	Scopes:
	•	sendActiveMails()
	•	API Queries:
	•	getMailerStats($id)

8. News

	•	Relationships:
	•	hasMany newsArticles
	•	Fillable:
	•	title, content
	•	Scopes:
	•	latestNews()
	•	Actions:
	•	publishArticle()
	•	API Queries:
	•	getLatestNews()

9. Newsellers

	•	Relationships:
	•	hasMany products
	•	Fillable:
	•	title, url
	•	Actions:
	•	createSeller()
	•	Scopes:
	•	activeSellers()
	•	API Queries:
	•	getSellerDetails($id)

10. Payments

	•	Relationships:
	•	belongsTo users
	•	Fillable:
	•	amount, status
	•	Actions:
	•	processPayment()
	•	API Queries:
	•	getPaymentHistory()

11. Purchases

	•	Relationships:
	•	belongsTo accounts
	•	Fillable:
	•	url, amount
	•	Scopes:
	•	completedPurchases()
	•	API Queries:
	•	getPurchaseDetails($id)

12. RDPs

	•	Relationships:
	•	belongsTo,  hasMany,
	•	Fillable:
	•	url, username
	•	Scopes:
	•	activeRdp()
	•	Actions:
	•	generateRDP()
	•	API Queries:
	•	getRdpDetails()

13. Resellers

	•	Relationships:
	•	hasMany products
	•	Fillable:
	•	username, url
	•	Actions:
	•	registerReseller()
	•	Scopes:
	•	activeResellers()
	•	API Queries:
	•	getResellerInfo($id)

14. Scampages

	•	Relationships:
	•	hasMany reports
	•	Fillable:
	•	url, scamname
	•	Scopes:
	•	flaggedScams()
	•	Actions:
	•	reportScam()
	•	API Queries:
	•	getScamReports()

15. Smtp

	•	Relationships:
	•	hasOne mailers
	•	Fillable:
	•	url, smtp_server
	•	Actions:
	•	configureSmtp()
	•	API Queries:
	•	getSmtpConfig($id)

16. Stufs

	•	Relationships:
	•	hasMany users
	•	Fillable:
	•	url, storename
	•	Scopes:
	•	activeStores()
	•	Actions:
	•	createStore()
	•	API Queries:
	•	getStoreDetails()

17. Tickets

	•	Relationships:
	•	belongsTo users
	•	Fillable:
	•	uid, issue
	•	Actions:
	•	createTicket()
	•	Scopes:
	•	openTickets()
	•	API Queries:
	•	getTicketDetails()

18. Tutorials

	•	Relationships:
	•	belongsTo Resseller,  hasMany Resseller, hasOne Admin,  manyTomany User
	•	Fillable:
	 `id` bigint(20) UNSIGNED NOT NULL,
  `acctype` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `infos` text NOT NULL,
  `url` text NOT NULL,
  `price` int(11) NOT NULL,
  `resseller` varchar(255) NOT NULL,
  `sold` int(11) NOT NULL,
  `sto` varchar(255) NOT NULL,
  `dateofsold` timestamp NULL DEFAULT NULL,
  `tutoname` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
	•	Actions:
	•	buyTutorials()
 • checkTutorials()
	• PostTutorials()
	• createTutorials()
	•	addTutorials()
 •	deleteTutorials()
  •	showTutorials()
  • configureTutorials()
  • reportTutorials()
  • generateTutorials()
  • captureTutorials()
	•	Scopes:
	•	addecTutorials()
	•	API Queries:
	•	getTutorialsList()

19. Users

	•	Relationships:
	•	hasMany purchases
	•	Casts:
	•	email, username (string)
	•	Fillable:
	•	username, email, password
	•	Scopes:
	•	activeUsers()
	•	Actions:
	•	resetPassword()
	•	Notifications:
	•	UserPasswordReset

Additional Configurations

	•	Array Definition:
	•	Each model’s fillable is an array (e.g., for accounts, it’s ['url', 'sitename', 'status']).
	•	Token Management:
	•	Implement Laravel Passport or Sanctum for token-based authentication for users.
	•	HTML Attributes:
	•	For rendering in HTML: url, image, storename should be treated as strings.
	•	Cron Jobs:
	•	For scheduled tasks, use artisan schedule:run for tasks like sendDailyReports(), cleanupOldData().
	•	Middleware:
	•	Implement authentication middleware (e.g., auth, admin roles) for route access control.
	•	Routes:
	•	Define routes in routes/web.php and routes/api.php for appropriate models and actions.
	•	Exceptions:
	•	Custom exceptions such as InsufficientFundsException can be defined for handling specific errors.

This structure provides a detailed layout for handling models, their relationships, attributes, actions, and various system configurations. You can expand each section based on your business requirements.