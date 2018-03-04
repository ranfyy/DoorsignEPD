DIRTO="~/src/DoorsignEPD/server/"
pushd ~/src/darksky/
    php index.php
    cp sample.txt $DIRTO
popd

pushd $DIRTO
    # top -b -n 1 -c > sample.txt
    php index.php
    DIRTO="~/src/raspberrypi/python/"
    cp sample.png $DIRTO
popd

pushd $DIRTO
    sudo python test.main.py
popd
