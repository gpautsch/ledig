#!/bin/bash
echo "Se INICIA copia de FS" > cronFS.log
# scriptFS.sh es el resultaco de copyFS.php y contiene las sentencias ssh de los pdf a copiar
sudo -u usuario sh /toba_2.7.13/proyectos/ledig/www/FS/scriptFS.sh >> cronFS.log
if [ $? -ne 0 ]; then
        # Si algo falla en scriptFS.sh 
        echo "Actualizando FS en nodo Sede: Se detectaron ERRORES" >> cronFS.log
else
        # Si scriptFS.sh se ejecuta con exito
        echo "Los FS se actualizo con exito" >> cronFS.log
        # Vacia la lista de comandos ssh
        cp /toba_2.7.13/proyectos/ledig/www/FS/scriptFS.000 ./scriptFS.sh >> cronFS.log
fi
echo "FIN script FS" >> cronFS.log
