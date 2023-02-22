# rkw_authors
## Upgrade to v9.5
Please make sure to execute the following MySQL-statements.
```
UPDATE tt_content SET list_type = "rkwauthors_main" WHERE list_type = "rkwauthors_rkwauthors";
UPDATE tt_content SET list_type = "rkwauthors_details" WHERE list_type = "rkwauthors_rkwauthorsdetail";
UPDATE tt_content SET list_type = "rkwauthors_headline" WHERE list_type = "rkwauthors_rkwauthorsheadline";
UPDATE tt_content SET list_type = "rkwauthors_contact" WHERE list_type = "rkwauthors_rkwauthorscontactbox";
```
