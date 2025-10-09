VERSION = "5.0.1"
VERSION2 = $(shell echo $(VERSION)|sed 's/ /-/g')
PACKAGE = mod_jofavcats
ZIPFILE = $(PACKAGE)-$(VERSION2).zip
UPDATEFILE = $(PACKAGE)-update.xml
ROOT = $(shell pwd)
PACKAGES = $(ROOT)/packages



.PHONY: $(ZIPFILE)

ALL : $(ZIPFILE) fixsha



ZIPIGNORES = -x "*.git*" -x "*.svn*" -x "thumbs/*" -x "*.zip"



$(ZIPFILE): 
	@echo "-------------------------------------------------------"
	@echo "Creating zip file for: $*"
	@rm -f $@
	@(cd $(ROOT); zip -r $@ * $(ZIPIGNORES))


fixversions:
	@echo "Updating all install xml files to version $(VERSION)"
	@find . \( -name '*.xml' ! -name 'default.xml' ! -name 'metadata.xml' ! -name 'config.xml' \) -exec  ./fixvd.sh {} $(VERSION) \;

revertversions:
	@echo "Reverting all install xml files"
	@find . \( -name '*.xml' ! -name 'default.xml' ! -name 'metadata.xml' ! -name 'config.xml' \) -exec git checkout {} \;

fixsha:
	@echo "Updating update xml files with checksums"
	@(cd $(ROOT);./fixsha.sh $(ZIPFILE) $(UPDATEFILE))





