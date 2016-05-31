--
-- PropelExport v0.5
--
-- The PropelExport Module allows you to export a catalog as propel xml-schema.
-- Currently Propel 1.2 and 1.3 is fully supported. It should also work with Propel 1.4, however
-- 1.4-specific features (such as behaviours) are not yet supported
--
--
-- This Module is Copyright (c) 2008-2009 CN-Consult GmbH
-- Author: Daniel Haas <daniel.haas@cn-consult.eu>
--
--
-- This module is free software; you can redistribute it and/or modify
-- it under the terms of the GNU General Public License as published by
-- the Free Software Foundation; version 2 of the License.
--
--
-- The module is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
-- without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
-- See the GNU General Public License for more details.
--
--
-- * IMPORTANT:
-- * If you find BUGS in this module or have ideas for IMPROVEMENTS or PATCHES, dont hesitate
-- * to contact me at daniel.haas@cn-consult.eu! Thanks!
--


-- CHANGELOG:
-- Version 0.1: Internal Version
-- Version 0.2: First released Version
-- Version 0.3: Added support for *TEXT columns (are converted to VARCHAR/LONGVARCHAR/CLOBs for propel)
-- Version 0.4:
--   * Added support to set database baseClass manually
--   * Added support to set phpName per table manually
--   * Added support for onDelete and onUpdate foreign key constraints (based on work by Antoine Noal aka Hvannentir)
--   * DATETIME type is converted to TIMESTAMP type
--   * size and scale support for DECIMAL columns (based on work by Antoine Noal aka Hvannentir)
--   * support for multiple foreign key references (thanks for pointing that out Antoine!)
-- Version 0.4.1: Fixed MEDIUMINT not being converted to INT for propel
-- Version 0.5:
--	 * Works with Workbench 5.1
--   * Added support for workbenchs user data types (This also fixes BOOLEANS appearing als UNKNOWN in WB 5.1)
--     (Note: This does not work with user-types defining precision and scale, due to a Bug in Workbench)
--   * Added support for Propel 1.3 defaultExpr
--   * Add name-attribute to unique-tags and index-tags
--   * Add size-attribute to unique- and index-tags only if a size is available
--   Note: This is the last Version that will support Propel 1.2, newer releases will only support >=Propel 1.3 (default= will be replaced with defaultValue=)


--
-- standard module/plugin functions
--

-- this function is called first by MySQL Workbench core to determine number of plugins in this module and basic plugin info
-- see the comments in the function body and adjust the parameters as appropriate
function getModuleInfo()
	return {
		name= "PropelExport",                     -- put your module name here; must be a valid identifier unique among
                                                        -- all other plugin names
		author= "CN-Consult GmbH",                  -- put your company name here
		version= "1.0",                         -- put module version string in form major.minor
		implements= "PluginInterface",          -- don't change this
		functions= {
                  "getPluginInfo:l<o@app.Plugin>:",     -- don't change this
                  "exportPropelSchemaToClipboard:i:o@db.Catalog",   -- list all your plugin function names and accepted argument types,
				  "exportPropelSchemaToFile:i:o@db.Catalog",
				  "setPropelExportBaseClass:i:o@db.Catalog",
				  "setPropelExportPhpName:i:o@db.Table"
                                                        -- keeping the rest unchanged; in this example there's only one
                                                        -- function, function name is PluginFunctionName and argument type
                                                        -- is db.Catalog
		}
	}
end


-- helper function to create a descriptor for an argument of a specific type of object
-- you don't need to change here anything
function objectPluginInput(type)
	return grtV.newObj("app.PluginObjectInput", {objectStructName= type})
end

-- this function is called by MySQL Workbench core after a successful call to getModuleInfo()
-- to gather information about the plugins in this module and the functions that the plugins expose;
-- a plugin should expose only one function that will handle a menu command for a class of objects
-- see the comments in the function body and adjust the parameters as appropriate
function getPluginInfo()
    local l
    local plugin

    -- create the list of plugins that this module exports
    l= grtV.newList("object", "app.Plugin")

    -- create a new app.Plugin object for every plugin
    plugin= grtV.newObj("app.Plugin", {
		name= "wb.catalog.util.exportPropelSchemaToClipboard",      -- plugin namespace
		caption= "PropelExport: Copy Catalog as Propel-Schema to Clipboard",                 -- plugin textual description (will appear as menu item name)
		moduleName= "PropelExport",                         -- this should be in sync with what you sepcified previously for module
															-- name in getModuleInfo()
		pluginType= "normal",                            -- don't change this
		moduleFunctionName= "exportPropelSchemaToClipboard",        -- the function that this plugin exposes
		inputValues= {objectPluginInput("db.Catalog")},  -- the type of object
		rating= 100,                                     -- don't change this
		showProgress= 0,                                 -- don't change this
		groups= {"Catalog/Utilities", "Menu/Catalog"}  -- use "Catalog/Utilities" to show the menu item on the overview page,
                                                                 -- or "Model/Utilities" to show the menu item on the canvas;
                                                                 -- the "Menu/*" entries control how the plugin will appear in main menu
                                                                 -- the possible values for it are "Menu/Model", "Menu/Catalog", "Menu/Objects",
                                                                 -- "Menu/Database", "Menu/Utilities"
	})

    -- fixup owner
    plugin.inputValues[1].owner= plugin

    -- add to the list of plugins
    grtV.insert(l, plugin)




    -- create a new app.Plugin object for every plugin
    plugin= grtV.newObj("app.Plugin", {
		name= "wb.catalog.util.exportPropelSchemaToFile",      -- plugin namespace
		caption= "PropelExport: Export Catalog as Propel-Schema to File",                 -- plugin textual description (will appear as menu item name)
		moduleName= "PropelExport",                        -- this should be in sync with what you sepcified previously for module
                                                                 -- name in getModuleInfo()
		pluginType= "normal",                            -- don't change this
		moduleFunctionName= "exportPropelSchemaToFile",        -- the function that this plugin exposes
		inputValues= {objectPluginInput("db.Catalog")},  -- the type of object
		rating= 100,                                     -- don't change this
		showProgress= 0,                                 -- don't change this
		groups= {"Catalog/Utilities", "Menu/Catalog"}  -- use "Catalog/Utilities" to show the menu item on the overview page,
                                                                 -- or "Model/Utilities" to show the menu item on the canvas;
                                                                 -- the "Menu/*" entries control how the plugin will appear in main menu
                                                                 -- the possible values for it are "Menu/Model", "Menu/Catalog", "Menu/Objects",
                                                                 -- "Menu/Database", "Menu/Utilities"
	})

    -- fixup owner
    plugin.inputValues[1].owner= plugin

    -- add to the list of plugins
    grtV.insert(l, plugin)




	-- create a new app.Plugin object for every plugin
    plugin= grtV.newObj("app.Plugin", {
		name= "wb.catalog.util.setPropelExportBaseClass",
        caption= "PropelExport: Set custom baseClass",
		moduleName= "PropelExport",
		pluginType= "normal",
		moduleFunctionName= "setPropelExportBaseClass",
		inputValues= {objectPluginInput("db.Catalog")},
		rating= 100,
		showProgress= 0,
		groups= {"Catalog/Utilities", "Menu/Catalog"}
	})

    -- fixup owner
    plugin.inputValues[1].owner= plugin

    -- add to the list of plugins
    grtV.insert(l, plugin)



	-- create a new app.Plugin object for every plugin
    plugin= grtV.newObj("app.Plugin", {
		name= "wb.table.util.setPropelExportPhpName",
        caption= "PropelExport: Set custom phpName",
		moduleName= "PropelExport",
		pluginType= "normal",
		moduleFunctionName= "setPropelExportPhpName",
		inputValues= {objectPluginInput("db.Table")},
		rating= 100,
		showProgress= 0,
		groups= {"Catalog/Utilities", "Menu/Table"}
	})
    -- fixup owner
    plugin.inputValues[1].owner= plugin

    -- add to the list of plugins
    grtV.insert(l, plugin)

    return l
end






-- Some needed definitions for the XMLWriter "class" (metatable)
XMLWriter = {}
XMLWriter_mt = {}
XMLWriter_mt.__index = XMLWriter

-- This is a very simplistic xml-serializer "class" in lua
-- With this method you create a new xmlwriter.
-- You have to at least pass the _rootTag
function XMLWriter:new(_rootTag,_encoding)
	xmlwriter={
		rootTag=_rootTag,
		encoding = _encoding or 'UTF-8',
		xml='',
		state='',
		openedTags={},
		newline='',
		indent='',
		useIndent=false
	}
	setmetatable(xmlwriter,XMLWriter_mt)
	xmlwriter:start()
	return xmlwriter
end

-- Start a new xml document
function XMLWriter:start()
	self.xml='<?xml version="1.0" encoding="'..self.encoding..'"?>\n'
	self.state='documentOpen'
	self.xml=self.xml..'<'..self.rootTag
end

-- Use this method to enable indenting the generated xml-code
-- Otherwise the xml is generated all on one line
function XMLWriter:enableIndent()
	self.useIndent=true
	self.newline='\n'
end

-- Internal method for pretty indenting
function XMLWriter:increaseIndent()
	if (self.useIndent==true) then
		local indent=string.len(self.indent)
		self.indent=string.rep(' ',indent+2)
	end
end

-- Internal method for pretty indenting
function XMLWriter:decreaseIndent()
	if (self.useIndent==true) then
		local indent=string.len(self.indent)
		if (indent<2) then indent=2 end
		self.indent=string.rep(' ',indent-2)
	end
end

-- begin a new tag with the given name
-- To add attributes to the tag use addAttribute().
-- Use addContent() to add content to the tag, or openTag() to add subtags.
function XMLWriter:openTag(_tagname)
	if (self.state~='tagClosed' and self.state~='insideTag') then self.increaseIndent(self) end
	if (_tagname) then
		if (self.state=='documentOpen' or self.state=='tagOpen' or self.state=='subTagOpen') then
			self.xml=self.xml..'>'..self.newline
		end
		self.xml=self.xml..self.indent..'<'.._tagname..''
		self.openedTags[#self.openedTags+1]=_tagname
		if (self.state=='tagOpen') then
			self.state='subTagOpen'
		else
			self.state='tagOpen'
		end
	else
		print("You have to pass a tagname when you open a tag!")
	end
end

-- Add an attribute to the currently open tag
-- Note: this method may not be called when you added content to the tag already
function XMLWriter:addAttribute(_name, _value)
	if (self.state=='tagOpen' or self.state=='subTagOpen' or self.state=='documentOpen') then
		self.xml=self.xml..' '.._name..'="'.._value..'"'
	end
end

-- Add content (cdata) to the currently open tag
-- Note: When adding content to a tag, you may not add attributes anymore to the tag
function XMLWriter:addContent(_content)
	if (self.state=='tagOpen' or self.state=='subTagOpen') then
		self.xml=self.xml..'>'
		self.state='insideTag'
	end
	self.xml=self.xml.._content;

end

-- Close a previously opened tag
function XMLWriter:closeTag()
	if (self.state=='tagOpen' or self.state=='subTagOpen') then
		self.xml=self.xml..'/>'..self.newline
		self.openedTags[#self.openedTags]=nil
		if (#self.openedTags==0) then
			self.state='tagClosed'
		else
			self.state='insideTag'
		end
	else if (self.state=='insideTag') then
		self.decreaseIndent(self)
		self.xml=self.xml..self.indent..'</'..self.openedTags[#self.openedTags]..'>'..self.newline
		self.openedTags[#self.openedTags]=nil
		if (#self.openedTags==0) then self.state='tagClosed' end

	end
	end

end

-- Finishes the document
-- This means closing the root tag
function XMLWriter:finishDocument()
	if (#self.openedTags > 0) then
		print("You still have opened tags!")
	else
		if (self.state=='documentOpen') then self.xml=self.xml..'>'..self.newline end
		self.xml=self.xml..'</'..self.rootTag..'>\n'
	end
end

-- Return the XML of the generated document
function XMLWriter:getXML()
	return self.xml
end




-- Test method which tests the XML Serializer
function testXml(catalog)
    print('This is lua Version '.._VERSION)
	local xml=XMLWriter:new('database')
	xml:enableIndent()
	xml:addAttribute("cool","ness")
	xml:openTag('test')
	xml:closeTag()
	xml:openTag('cool')
		xml:addAttribute('master','commander')
	xml:closeTag()
	xml:openTag('multi')
		xml:addAttribute('master','commander')
		xml:addContent('Mycontent')
	xml:closeTag()

	xml:openTag('aaaargh')
		xml:addAttribute('thelast','test')
		xml:openTag('subtag')
			xml:addAttribute('subattrib','value')
		xml:closeTag()
	xml:closeTag()

	xml:finishDocument()

	print (xml:getXML())
end







------------------------------
--- PropelExport util methods:
------------------------------

--
-- Print some version information and copyright to the output window
function printVersion()
	print("\n\n\nThis is PropelExport v0.5\nCopyright (c) 2008-2009 CN-Consult GmbH");
end


--
-- Convert workbench simple types to propel types
function wbSimpleType2PropelDatatype(simpleType)

  -- local propelType="**UNKNOWN** ("..simpleType.name..")"
  -- We assume that the simpleType corresponds to the propel type by default
  -- This is correct 95% of the time
  if (simpleType~=nil) then

	  local propelType=simpleType.name

	  -- convert INT to INTEGER
	  if (simpleType.name=="INT" or simpleType.name=="MEDIUMINT") then
		propelType = "INTEGER"
	  end

	  -- convert text types to CLOBs
	  if (simpleType.name=="TINYTEXT") then
		propelType = "VARCHAR"
	  end
	  if (simpleType.name=="TEXT") then
		propelType = "LONGVARCHAR"
	  end
	  if (simpleType.name=="MEDIUMTEXT") then
		propelType = "CLOB"
	  end
	  if (simpleType.name=="LONGTEXT") then
		propelType = "CLOB"
	  end

	  -- convert DATETIME TO TIMESTAMP (this will be converted back to DATETIME by Propel 1.3)
	  if (simpleType.name=="DATETIME") then
		propelType = "TIMESTAMP"
	  end


	return propelType
  else
    return "EMPTY SIMPLETYPE"
  end
end

--
-- Tries to convert workbench user types to propel types
function wbUserType2PropelDatatype(userType)

  -- local propelType="**UNKNOWN** ("..simpleType.name..")"
  -- We assume that the simpleType corresponds to the propel type by default
  -- This is correct 95% of the time
  if (userType~=nil) then

	  local propelType=""

	  -- convert MySQL Workbench defined user-types to Propel-Types
	  if (userType.name=="BOOL") then
		propelType = "BOOLEAN"
	  end
	  if (userType.name=="BOOLEAN") then
		propelType = "BOOLEAN"
	  end

	  -- if you have custom mappings you could add cases for them here:


	  -- Check if we found a conversion, if not use the simple-type converter with the actual definition of the user-type
	  if (propelType=="") then
		propelType=wbSimpleType2PropelDatatype(userType.actualType)
	  end

	return propelType
  else
    return "EMPTY USERTYPE"
  end
end


--
-- converts unusable characters to underscores
function sanitizeName(name)
	local newName= name.gsub(name,'%-','_')
	local newName2=string.gsub(newName,'%s+',"_")
	return newName2;
end




--
-- Takes a catalog object and converts it to a propel xml-schema
-- This method is called from the two plugin entry-points to generate the actual schema
function geneneratePropelSchemaFromCatalog(catalog)
  local xml=XMLWriter:new('database')
  xml:enableIndent()

  local firstSchema = catalog.schemata[1]

  xml:addAttribute("defaultIdMethod","native")
  xml:addAttribute("name",firstSchema.name)

  if (catalog.customData["propelExportBaseClass"]~= nil) then
	xml:addAttribute("baseClass",catalog.customData["propelExportBaseClass"]);
  end

  -- go through all tables:
    for i = 1, grtV.getn(catalog.schemata) do
        schema = catalog.schemata[i]
        for j = 1, grtV.getn(schema.tables) do
            currentTable = schema.tables[j]
			xml:openTag('table')
				xml:addAttribute('name',currentTable.name)

			if (currentTable.customData["phpName"]~=nil)
			then
				xml:addAttribute('phpName',currentTable.customData["phpName"]);
			end

			-- now fetch all columns:
			for k = 1, grtV.getn(currentTable.columns) do
				currentColumn=currentTable.columns[k]
				local propelType=''
				xml:openTag('column')
					xml:addAttribute('name',currentColumn.name)

					if (currentColumn.simpleType~=nil)
					then
						propelType=wbSimpleType2PropelDatatype(currentColumn.simpleType)
					else
						propelType=wbUserType2PropelDatatype(currentColumn.userType)
					end

					xml:addAttribute('type',propelType)

					if (currentColumn.length~=-1) then
						xml:addAttribute('size',currentColumn.length)
					end

					local columnType=nil;
					if (currentColumn.simpleType~=nil)
					then columnType=currentColumn.simpleType
					else columnType=currentColumn.userType.actualType end


					if (propelType=="CLOB" or propelType=="VARCHAR") then
						if 	   (columnType.name=="TINYTEXT")	then xml:addAttribute('size',255);
						elseif (columnType.name=="MEDIUMTEXT")then xml:addAttribute('size',16777215);
						elseif (columnType.name=="LONGTEXT")	then xml:addAttribute('size',4294967295); end
					elseif (columnType.name=="DECIMAL") then
						xml:addAttribute('size',currentColumn.precision);
						xml:addAttribute('scale',currentColumn.scale);
					end


					-- try to find out if this is the primary key column
					for k = 1, grtV.getn(currentTable.indices) do
						index=currentTable.indices[k]
						if (index.indexType=="PRIMARY") then
							for l=1, grtV.getn(index.columns) do
								column=index.columns[l]
								if (column.referencedColumn.name==currentColumn.name) then
									xml:addAttribute('primaryKey','true')
								end
							end
						end
					end

					if (currentColumn.isNotNull==1) then
						xml:addAttribute('required','true')
					end
					-- add a default value if available
					if (currentColumn.defaultValue~='' and currentColumn.defaultValue~='CURRENT_TIMESTAMP') then
						xml:addAttribute('default',currentColumn.defaultValue)
					end
					-- add Propel 1.3 defaultExpr
					if (currentColumn.defaultValue~="") then
						xml:addAttribute('defaultExpr',currentColumn.defaultValue)
						-- print ("Default Value:"..currentColumn.defaultValue.."\n")
					end
					if (currentColumn.autoIncrement==1) then
						xml:addAttribute('autoIncrement','true')
					end
					if (currentColumn.comment~='') then
						xml:addAttribute('description',currentColumn.comment)
					end
				xml:closeTag()
			end
			-- add foreign keys:
			for k = 1, grtV.getn(currentTable.foreignKeys) do
				foreignKey=currentTable.foreignKeys[k]
				xml:openTag('foreign-key')
					xml:addAttribute('name',sanitizeName(foreignKey.name))
					xml:addAttribute('foreignTable',foreignKey.referencedTable.name)
					if(foreignKey.deleteRule~="" and foreignKey.deleteRule~="NO ACTION") then
						xml:addAttribute('onDelete',string.lower(foreignKey.deleteRule))
					end
					if(foreignKey.updateRule~="" and foreignKey.updateRule~="NO ACTION") then
						xml:addAttribute('onUpdate',string.lower(foreignKey.updateRule))
					end
					for l=1, grtV.getn(foreignKey.columns) do
						xml:openTag('reference')
							xml:addAttribute('local',foreignKey.columns[l].name)
							xml:addAttribute('foreign',foreignKey.referencedColumns[l].name)
						xml:closeTag()
					end
				xml:closeTag()
			end
			-- add unique keys:
			for k = 1, grtV.getn(currentTable.indices) do
				index=currentTable.indices[k]
				if (index.indexType=="UNIQUE") then
					xml:openTag('unique')
					xml:addAttribute('name',sanitizeName(index.name))
					for l=1, grtV.getn(index.columns) do
						column=index.columns[l]
						xml:openTag('unique-column')
							xml:addAttribute('name',column.referencedColumn.name)
							if (column.referencedColumn.length>0) then xml:addAttribute('size',column.referencedColumn.length) end
						xml:closeTag()
					end
					xml:closeTag()
				end
			end
			-- add remaining indices
			for k = 1, grtV.getn(currentTable.indices) do
				index=currentTable.indices[k]
				if (index.indexType=="INDEX") then
					xml:openTag('index')
					xml:addAttribute('name',sanitizeName(index.name))
					for l=1, grtV.getn(index.columns) do
						column=index.columns[l]
						xml:openTag('index-column')
							xml:addAttribute('name',column.referencedColumn.name)
						xml:closeTag()
					end
					xml:closeTag()
				end
			end
			xml:closeTag()
        end
    end

  xml:finishDocument()
  return xml:getXML();

end
















------------------
-- Plugin methods:
------------------




--
-- Export the propel-schema of the selected catalog to the clipboard
-- This is the main plugin method which is called from the menu
function exportPropelSchemaToClipboard(catalog)
  printVersion();

  local propelSchema=geneneratePropelSchemaFromCatalog(catalog);
  --  print ("Propel-Schema looks like this:\n")
  --  print(propelSchema);

  Workbench:copyToClipboard(propelSchema)
  print('\n > Propel-Schema was copied to clipboard');
  return 0
end





--
-- Export the propel-schema of the selected catalog to the a filename
-- This is the main plugin method which is called from the menu
function exportPropelSchemaToFile(catalog)
  printVersion();

  local propelSchema=geneneratePropelSchemaFromCatalog(catalog);
  --  print ("Propel-Schema looks like this:\n")
  --  print(propelSchema);

  if (catalog.customData["propelExportPath"] ~= nil) then
	-- print("\nFilepath is: "..catalog.customData["propelExportPath"]);
	if (Workbench:confirm("Proceed?","Do you want to overwrite previously exported file "..catalog.customData["propelExportPath"].." ?") == 1)
	then
		propelExportPath=catalog.customData["propelExportPath"];
	else
		propelExportPath=Workbench:input('Filename? Please enter Filename to export the propel schema to');
		if (propelExportPath~="")
		then
			-- Try to save the filepath for the next time:
			catalog.customData["propelExportPath"]=propelExportPath;
		end
	end
  else
	propelExportPath=Workbench:input('Filename? Please enter Filename to export the propel schema to');
	if (propelExportPath~="")
	then
		-- Try to save the filepath for the next time:
		catalog.customData["propelExportPath"]=propelExportPath;
	end
  end

  if propelExportPath~='' then
	f = io.open(propelExportPath,"w");
	if (f~=nil) then
		f.write(f,propelSchema);
		f.close(f);
		print('\n > Propel-Schema was exported to '..propelExportPath);
	else
		print('\n > Could not open file '..propelExportPath..'!');
	end
  else
	print('\n > Propel-Schema was NOT exported as no path was given!');
  end

  return 0
end


--
-- Set a custom baseClass to be added to the database tag of the resulting schema file.
-- This is saved inside the workbench file, so on subsequent exports it is reused.
function setPropelExportBaseClass(catalog)
	printVersion();
	print("Setting baseClass...");

	local question="New baseClass?";
	if (catalog.customData["propelExportBaseClass"]~=nil) then
		question = question .. " (" .. catalog.customData["propelExportBaseClass"] ..")"
	end
	propelExportBaseClass=Workbench:input(question);

		if (propelExportBaseClass==" ")
		then
			-- Remove the previously set base-class
			catalog.customData["propelExportBaseClass"]=nil;
		elseif (propelExportBaseClass~="")
		then
			-- Try to save the base-class
			catalog.customData["propelExportBaseClass"]=propelExportBaseClass;
		end
	print ("done");
end




--
-- Sets a custom phpName for a table.
-- If you want to unset the phpName, enter a single space as phpName
function setPropelExportPhpName(_table)
	printVersion();
	print("Setting phpName of " .. _table.name);

	local question="New phpName?";
	if (_table.customData["phpName"]~=nil) then
		question = question .. " (" .. _table.customData["phpName"] ..")";
	end
	phpName=Workbench:input(question);

	if (phpName==" ")
	then
		-- Remove the previously set phpName
		_table.customData["phpName"]=nil;
	elseif (phpName~="")
	then
		-- Try to save the phpName
		_table.customData["phpName"]=phpName;
	end

	--this is a trick to let MySQL Workbench believe there are changes in the file:
	_table.owner.owner.owner.customData["phpName".._table.name]="set";
	print ("done");
end

