#!/bin/bash

cd ..

find . -name "*.php" -print0 | xargs -0 xgettext --keyword=nau_trans --language=PHP --add-comments --sort-output -o languages/messages.pot

msgmerge --update languages/pt/messages.po languages/messages.pot
msgmerge --update languages/en/messages.po languages/messages.pot

msgfmt --output-file=languages/pt_PT.mo languages/pt/messages.po
msgfmt --output-file=languages/en_US.mo languages/en/messages.po

cd -
