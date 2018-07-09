# JBZoo Teamcity Key Keeper [![Build Status](https://travis-ci.org/JBZoo/Teamcity-KeyKeeper.svg?branch=master)](https://travis-ci.org/JBZoo/Teamcity-KeyKeeper)

Save some string data between Teamcity builds and restore them as environment variables.

Save
```sh
teamcity-keykeeper key:save    --name="some_env_var_name"  --value="some_value";
teamcity-keykeeper key:save    --name="some_env_var_name2" --value="some_value2";
```

Restore
```sh
teamcity-keykeeper key:restore --all;
##teamcity[setParameter name='env.SOME_ENV_VAR_NAME' value='some_value']
##teamcity[setParameter name='env.SOME_ENV_VAR_NAME2' value='some_value2']
```

Get clean
```sh
teamcity-keykeeper key:get --name="some_env_var_name";
some_value
```


### License

MIT
