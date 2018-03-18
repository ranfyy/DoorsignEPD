DIRTO="$HOME/src/DoorsignEPD/server/"
pushd $HOME/src/darksky/
    php index.php
    cp sample.txt $DIRTO
popd

pushd $DIRTO
    # top -b -n 1 -c > sample.txt
    php index.php
    DIRTO="$HOME/src/raspberrypi/python/"
    cp sample.png $DIRTO
popd

pushd $DIRTO
    sudo python test.main.py
popd
