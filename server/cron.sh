DIRTO="$HOME/src/DoorsignEPD/server/"
pushd $HOME/src/darksky/
    php index.php
    cp sample.txt $DIRTO
popd

pushd $DIRTO
    # https://www.waveshare.com/wiki/File:2.7inch-e-paper-hat-code.7z
    php index.php
    DIRTO="$HOME/src/raspberrypi/python/"
    cp sample.png $DIRTO
popd

pushd $DIRTO
    sudo python test.main.py
popd
