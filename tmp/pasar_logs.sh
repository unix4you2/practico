#Pasar logs de Git a formato apropiado para CodesWarm:

git log --name-status --pretty=format:'%n------------------------------------------------------------------------ %nr%h | %ae | %ai (%aD) | x lines%nChanged paths: %N' > actividad_practico.log 



