#1 Weboldal futtatása

A weboldal futtatásához először importálnunk kell az adatbázis SQL fájlját a phpMyAdmin felhasználói felületén. Csak ezután lesz lehetőségünk a weboldal használatára.


#2 Adatbázis importálása

1. Nyisd meg a phpMyAdmin felhasználói felületét a webböngésződben.
2. Jelentkezzen be a megfelelő felhasználónév és jelszó segítségével a phpMyAdmin "Felhasználói Fiókok" menüpont alatt.
	Felhasználónév: TestDBUsername
	Jelszó:			TestDBPassword
3. Hozza létre a "BeYou" adatbázist.
4. Navigáljon az "Import" menüpontra.
5. Válassza ki az adatbázis SQL fájlját (beyou.sql) a BeYouProject mappából.
6. Kattintson az "Importálás" gombra, hogy elindítsa az adatbázis importálását.

A fenti lépések elvégzése után az adatbázisban található táblák és adatok elérhetőek lesznek a weboldal számára, és így a weboldal megfelelően fog működni.


#3 Weboldal megnyitása 

Nyissa meg a következő oldalt a böngészőben: http://localhost/BeYouProject/Frontend/user_area/Home.html


A bejelentkezéshez szükséges adatok:

Vásárlói felület:
Felhasználónév:	TestUser
Jelszó:			TestPW

Adminisztrációs felület:
Felhasználónév:	TestAdmin
Jelszó:			TestPW