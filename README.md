# JBZoo TeamcityKeyKeeper [![Build Status](https://travis-ci.org/JBZoo/Teamcity-KeyKeeper.svg?branch=master)](https://travis-ci.org/JBZoo/Teamcity-KeyKeeper)


```sh
teamcity-keykeeper key:save    --name="some_env_var_name" --value="some_value";
teamcity-keykeeper key:restore --all;
```

Output
```sh
##teamcity[setParameter name='env.SOME_ENV_VAR_NAME' value='some_value']
```


### License

MIT
