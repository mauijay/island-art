@echo off 
cd /d "C:\1.Git\01_ci4\463\02_MyProjects\islandArt\ci4" 
php spark events:collect >> "C:\1.Git\01_ci4\463\02_MyProjects\islandArt\ci4\writable\logs\event_collection.log" 2>&1 
