# ShopEasy

The Software used for the project are:

1.	Sublime text: Sublime Text is a shareware cross-platform source code editor with a Python application programming interface (API). It natively supports many programming languages and markup languages, and functions can be added by users with plugins, typically community-built and maintained under free-software licenses.

2.	XAMPP Server: XAMPP is an abbreviation for cross-platform, Apache, MySQL, PHP, phpMyAdmin, and Perl, and it allows you to build WordPress site offline, on a local web server on your computer. This simple and lightweight solution works on Windows, Linux, and Mac – hence the “cross-platform” part.

SUBLIME TEXT INSTALLATION:

Steps for installing sublime text software:
•	Download the version of Sublime Text appropriate for the version of Windows you're running. 

•	Double-click on Sublime Text Setup.exe.


•	Click Next > Next > Next > Install, with one exception: on the Select Additional Tasks screen, check the box next to Add To Explorer Context Menu.

•	Run the application, once opened click on File > Open Folder. All the project folders and files will appear on left side.

XAMPP INSATLLATION:

XAMPP is a server manager which allows you to run Apache, MySQL, and other types of servers from the same dashboard.
Steps for installing XAMPP Software:
1.	Open the XAMPP website. Go to https://www.apachefriends.org/index.html in your computer's web browser.

2.	Click XAMPP for Windows. It's a grey button near the bottom of the page.


3.	Double-click the downloaded file. This file should be named something like xampp-win32-7.2.4-0-VC15-installer.


4.	Click Yes when prompted. This will open the XAMPP setup window.

5.	Click Next. It's at the bottom of the setup window.


6.	Select aspects of XAMPP to install. Review the list of XAMPP attributes on the left side of the window; if you see an attribute that you don't want to install as part of XAMPP, uncheck its box.By default, all attributes are included in your XAMPP installation.

7.	Click Next. It's at the bottom of the window.

8.	Select an installation location. Click the folder-shaped icon to the right of the current installation destination, then click a folder on your computer.

9.	Click OK. Doing so confirms your selected folder as your XAMPP installation location.


10.	Click Next. You'll find it at the bottom of the page.

11.	Uncheck the "Learn more about Bitnami" box, then click Next. 


12.	Begin installing XAMPP. Click Next at the bottom of the window to do so. XAMPP will begin installing its files into the folder that you selected.

13.	Click Finish when prompted. It's at the bottom of the XAMPP window. Doing so will close the window and open the XAMPP Control Panel, which is where you'll access your servers.


14.	Select a language. Check the box next to the American flag for English, or check the box next to the German flag for German.

15.	Click Save. Doing so opens the main Control Panel page.


16.	Start XAMPP from its installation point. If you need to open the XAMPP Control Panel in the future, you can do so by opening the folder in which you installed XAMPP, right-clicking the orange-and-white xampp-control icon, clicking Run as administrator, and clicking Yes when prompted.When you do this, you'll see red X marks to the left of each server type.

Clicking one of these will prompt you to click Yes if you want to install the server type's software on your computer.

17.	Resolve issues with Apache refusing to run. On some Windows 10 computers, Apache won't run due to a "blocked port". This can happen for a couple of reasons, but there's a relatively easy fix:
Click Config to the right of the "Apache" heading.
Click Apache in the menu.
              Select the available port.
Press Ctrl+S to save the changes, then exit the text editor.
Restart XAMPP by clicking Quit and then re-opening it in administrator mode from its folder.

ACCESSING THE DATABASE MySQL THROUGH phpMyAdmin:

•	To access phpMyAdmin from XAMPP you will need to make sure you have Apache and MySQL running in the XAMPP control panel by clicking the start buttons under the Actions column.

•	If Apache and MySQL are green then all is well.  Then you can click the “Admin” button in the MySQL row and that will launch phpMyAdmin.


•	You can also access phpMyAdmin by typing in http://localhost/phpmyadmin/ into your browser.  The first time you access it, you will need to login using “root” as the username and there will be no password.  Once you’ve typed that in, click on “Go”.

•	Once you are logged in, change your password to secure your databases and their settings.


•	After you’ve done that.  You will want to create a new database.

•	You will then be prompted to name the database, do so, and then click on “Create”.


•	Then you will be asked to create a table with however many columns you want.  Once you’ve decided that, click “Go” again.

•	This will require that you preplan your database a bit.  You’ll need to know exactly what you will be storing in it. Once we filled in those fields, we would click “Save”.

LIBRARIES REQUIRED:
The libraries pandas, numpy, scikit-learn are installed using (pip has to be installed before installing the above libraries) :
pip install pandas numpy scikit-learn
 

