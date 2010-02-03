<?php

require_once 'EmuSQL/Exception.php';

// {{{

class EmuSQL
{

	// {{{ constants

	/**
	 * Standard errors
	 *
	 * @const
	 */
	const ERROR_OK = 0;
	const ERROR_UNKNOWN = 1;

	/**
	 * Fetch mode definitions
	 *
	 * @const
	 */
	const FETCHMODE_DEFAULT = 0x0000;
	const FETCHMODE_ASSOC   = 0x0001;
	const FETCHMODE_NUM     = 0x0002;
	const FETCHMODE_BOTH    = 0x0003;

	// }}}
	// {{{ variables

	/**
	 * Full specification of the database
	 *
	 * @var		assoc.array
	 * @access	private
	 */
	var $_filename;

	/**
	 * File handler of opened database
	 *
	 * @var		resource
	 * @access	private
	 */
	var $_db;

	/**
	 * Error code
	 *
	 * @var		integer
	 * @access	private
	 */
	var $_errno;

	/**
	 * Options
	 *
	 * @var		assoc.array
	 * @access	private
	 */
	var $_options = array(
		'fetchmode'	=> EmuSQL::FETCHMODE_ASSOC,

		'debug'		=> false,

		'usesocket'	=> false,
		'sockport'	=> 0,
		'socktimeout'	=> 0,
	);

	// }}}
	// {{{ methods

	/**
	 * Constructor
	 *
	 * @param	string	$filename
	 * @param	array	$options
	 * @return	EmuSQL  instance
	 * @access	public
	 */
	function __construct($dsn='', $options=array())
	{
		$this->setOptions($options);
		$this->connect($dsn);
	}

	// }}}
	// {{{

	/**
	 * Closes this database connection
	 *
	 * @param	void
	 * @return	boolean
	 * @access	public
	 */
	function close()
	{
		if ( $this->_errno ) {
			return $this->throwError();
		}

		if ( ! $this->_db ) {
			return $this->throwError();
		}

		$this->disconnect();
	}

	// }}}
	// {{{

	/**
	 * Open a connection to the database specified by DSN
	 *
	 * @param	string	$dsn
	 * @return	void
	 * @access	public
	 */
	function connect($dsn='')
	{
		$dsn = self::parseDSN($dsn);
	}

	// }}}
	// {{{

	/**
	 * Close a connection to the database
	 *
	 * @param	void
	 * @return	void
	 * @access	public
	 */
	function disconnect()
	{
	}

	// }}}
	// {{{

	/**
	 * Escapes a string for use in a EmuSQL->query()
	 *
	 * @param	string	$string
	 * @return	string
	 * @access	public
	 */
	function escape($string)
	{
		return $string;
	}

	// }}}
	// {{{

	/**
	 * Fetch a result row as an associative array, a numeric array, or both.
	 *
	 * @param	integer	$fetchmode
	 * @return	mixed
	 * @access	public
	 */
	function fetch($fetchmode=EmuSQL::FETCHMODE_DEFAULT)
	{
		if ( $fetchmode == EmuSQL::FETCHMODE_DEFAULT ) {
			$fetchmode = $this->_fetchmode;
		} else {
			$this->_isValidFetchMode($fetchmode);
		}
	}

	// }}}
	// {{{

	/**
	 * Returns the text of the error message from previous operation
	 *
	 * @param	void
	 * @return	string
	 * @access	public
	 */
	function getError()
	{
	}

	// }}}
	// {{{

	/**
	 * Try the argument as Data Source Name, parse it and return parts of it.
	 *
	 * @param	mixed
	 * @return	array
	 * @access	public
	 */
	function parseDSN($dsn)
	{
	}

	// }}}
	// {{{

	/**
	 * Sends a query to the database
	 *
	 * @param	string	$query
	 * @return	mixed
	 * @access	public
	 */
	function query($query)
	{
		$sql = self::_parseSQL($query);
	}

	// }}}
	// {{{

	/**
	 * Modifies the default fetchmode
	 *
	 * @param	integer	$fetchmode
	 * @return	void
	 * @access	public
	 */
	function setFetchMode($fetchmode)
	{
		if ( $this->_isValidFetchMode($fetchmode) ) {
			$this->_options['fetchmode'] = $fetchmode;
		}
	}

	// }}}
	// {{{

	/**
	 * Modifies options for this database
	 *
	 * @param	array	$options
	 * @return	void
	 * @access	public
	 */
	function setOptions($options)
	{
		foreach ($this->_options as $k => $v) {
			if ( ! isset($options[$k]) ) {
				continue;
			}
			$this->_options[$k] = $options[$k];
		}

		$this->_isValidFetchMode($this->_options['fetchmode']);
	}

	// }}}
	// {{{

	/**
	 * Generates exception, specified by its number
	 *
	 * @param	integer	$errno
	 * @return	EmuSQL_Exception
	 * @access	public
	 */
	function throwError($errno=EmuSQL::ERROR_UNKNOWN)
	{
		throw new EmuSQL_Exception;
	}

	// }}}
	// {{{ private

	function _isValidFetchMode($fetchmode)
	{
		if ( $fetchmode < EmuSQL::FETCHMODE_ASSOC || $fetchmode > EmuSQL::FETCHMODE_BOTH ) {
			return $this->throwError();
		}
		return true;
	}

	// }}}
	// {{{

	function _parseSQL($sql)
	{
	}

	// }}}

}

// }}}

?>