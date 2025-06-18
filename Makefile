VERSION = "5.0.0"
VERSION2 = $(shell echo $(VERSION)|sed 's/ /-/g')
ZIPFILE = mod_jofavcats-$(VERSION2).zip
UPDATEFILE =  mod_jofavcats-update.xml
ROOT = $(shell pwd)
PACKAGES = $(ROOT)/packages


# Only set DATE if you need to force the date.  
# (Otherwise it uses the current date.)
# DATE = "February 19, 2011"


.PHONY: $(ZIPFILE)

ALL : $(ZIPFILE) fixsha

INSTALLS = xmap_plugin \
		xmap_component


ZIPIGNORES = -x "*.git*" -x "*.svn*" -x "thumbs/*" -x "*.zip"



$(ZIPFILE): 
	@echo "-------------------------------------------------------"
	@echo "Creating zip file for: $*"
	@rm -f $@
	@(cd $(ROOT); zip -r $@ * $(ZIPIGNORES))


fixsha:
	@echo "Updating update xml files with checksums"
	@(cd $(ROOT);./fixsha.sh $(ZIPFILE) $(UPDATEFILE))


fixversions:
	@echo "Updating all install xml files to version $(VERSION)"
	@export ATVERS=$(VERSION); export ATDATE=$(DATE); find . \( -name '*.xml' ! -name 'default.xml' ! -name 'metadata.xml' ! -name 'config.xml' \) -exec  ./fixvd {} \;



