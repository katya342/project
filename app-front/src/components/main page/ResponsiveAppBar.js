import React, { useState, useEffect } from 'react';
import { styled, alpha } from '@mui/material/styles';
import {
    AppBar,
    Box,
    Toolbar,
    IconButton,
    Typography,
    InputBase,
    Badge,
    MenuItem,
    Menu,
    Avatar,
    Link,
    Popover,
} from '@mui/material';
import {
    Menu as MenuIcon,
    Search as SearchIcon,
    AccountCircle,
    Notifications as NotificationsIcon,
} from '@mui/icons-material';
import { useNavigate } from 'react-router-dom';
import { CustomDialog } from '../CustomDialog';
import { BASE_URL } from '../constants';
import { extractFileName } from '../utils/avatarUtils';
import Notify from '../notifictations/Notifies';
import api from '../../api';
const Search = styled('div')(({ theme }) => ({
    position: 'relative',
    borderRadius: theme.shape.borderRadius,
    backgroundColor: alpha(theme.palette.common.white, 0.15),
    '&:hover': {
        backgroundColor: alpha(theme.palette.common.white, 0.25),
    },
    marginRight: theme.spacing(2),
    marginLeft: 0,
    width: '100%',
    [theme.breakpoints.up('sm')]: {
        marginLeft: theme.spacing(3),
        width: 'auto',
    },
}));

const SearchIconWrapper = styled('div')(({ theme }) => ({
    padding: theme.spacing(0, 2),
    height: '100%',
    position: 'absolute',
    pointerEvents: 'none',
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'center',
}));

const StyledInputBase = styled(InputBase)(({ theme }) => ({
    color: 'inherit',
    '& .MuiInputBase-input': {
        padding: theme.spacing(1, 1, 1, 0),
        paddingLeft: `calc(1em + ${theme.spacing(4)})`,
        transition: theme.transitions.create('width'),
        width: '100%',
        [theme.breakpoints.up('md')]: {
            width: '20ch',
        },
    },
}));

export default function NavBar() {
    const [isOpen, setIsOpen] = React.useState(false);
    const [avatar, setAvatar] = useState("");
    const handleDialogClose = () => { setIsOpen(false) };
    const [anchorElAccount, setAnchorElAccount] = React.useState(null);
    const [anchorElNotify, setAnchorElNotify] = React.useState(null);
    const [notifyCount, setNotifyCount] = useState(0);

    const navigate = useNavigate();
    const isMenuOpen = Boolean(anchorElAccount);
    const isNotifyOpen = Boolean(anchorElNotify);

    React.useEffect(() => {
        const storedAvatar = localStorage.getItem('avatar');
        if (storedAvatar) {
            const image = extractFileName(storedAvatar);
            console.log(image);
            setAvatar(image);
        }
    }, []);
   

    const handleProfileMenuOpen = (event) => {
        setAnchorElAccount(event.currentTarget);
    };

    const handleNotifyMenuOpen = (event) => {
        setAnchorElNotify(event.currentTarget);
    }

    const handleMenuClose = () => {
        setAnchorElAccount(null);
        setAnchorElNotify(null);
    };

    const handleWorkoutsClick = () => {
        handleMenuClose();
        const userToken = localStorage.getItem('user_token');
        if (userToken == null) {
            setIsOpen(true);
        }
        else {
            navigate('/user/workouts');
        }
    }

    const handleMyAccountClick = () => {
        handleMenuClose();
        const userToken = localStorage.getItem('user_token');
        if (userToken == null) {
            setIsOpen(true);
        }
        else {
            navigate('/account');
        }
    };

    const menuId = 'primary-search-account-menu';
    const notifyId = 'primary-search-notify-menu';
    const renderMenu = (
        <Menu
            anchorEl={anchorElAccount}
            anchorOrigin={{
                vertical: 'top',
                horizontal: 'right',
            }}
            id={menuId}
            keepMounted
            transformOrigin={{
                vertical: 'top',
                horizontal: 'right',
            }}
            open={isMenuOpen}
            onClose={handleMenuClose}
        >
            <MenuItem onClick={handleMyAccountClick}>My account</MenuItem>
            {/* <MenuItem>Subscriptions</MenuItem> */}
            <MenuItem onClick={() => handleWorkoutsClick()}>Workouts</MenuItem>
        </Menu>
    );

    const renderNotify = (
        <Popover
            open={isNotifyOpen}
            anchorEl={anchorElNotify}
            onClose={handleMenuClose}
            anchorOrigin={{
                vertical: 'bottom',
                horizontal: 'left',
            }}
            transformOrigin={{
                vertical: 'top',
                horizontal: 'left',
            }}
           
        >
            <Box sx={{ width: '415px', height: '200px' }}>
            <Notify setNotifyCount={setNotifyCount} />
        </Box>
           
        </Popover>
    )
    

    return (
        <Box sx={{ flexGrow: 1 }}>
            <AppBar position="static" sx={{ backgroundColor: 'gray' }}>
                <Toolbar>
                    <IconButton
                        size="large"
                        edge="start"
                        color="inherit"
                        aria-label="open drawer"
                        sx={{ mr: 2 }}
                    >
                        <MenuIcon />
                    </IconButton>
                    <Typography
                        variant="h6"
                        noWrap
                        component="div"
                        sx={{ display: { xs: 'none', sm: 'block' } }}
                    >
                        Home
                    </Typography>

                    <Search>
                        <SearchIconWrapper>
                            <SearchIcon />
                        </SearchIconWrapper>
                        <StyledInputBase
                            placeholder="Search…"
                            inputProps={{ 'aria-label': 'search' }}
                        />
                    </Search>
                    <Box sx={{ flexGrow: 1 }} />
                    <Box sx={{ display: { xs: 'none', md: 'flex' } }}>
                        <IconButton
                            onClick={handleNotifyMenuOpen}
                            size="large"
                            aria-label="show 17 new notifications"
                            color="inherit"
                        >
                            <Badge badgeContent={notifyCount} color="error">
                                <NotificationsIcon />
                            </Badge>
                        </IconButton>
                        <IconButton
                            size="large"
                            edge="end"
                            aria-label="account of current user"
                            aria-controls={menuId}
                            aria-haspopup="true"
                            onClick={handleProfileMenuOpen}
                            color="inherit"
                        >
                            {avatar ?
                                <Avatar alt='User' src={`${BASE_URL}storage/${avatar}`}></Avatar> : <AccountCircle fontSize='large'></AccountCircle>
                            }
                        </IconButton>
                    </Box>

                </Toolbar>
            </AppBar>
            {renderNotify}
            {renderMenu}
            <CustomDialog isOpen={isOpen} handleClose={handleDialogClose} title='You are not authorized'>
                <Link component="button" variant='body2' onClick={() => { navigate('/login') }}>Authorize</Link>
            </CustomDialog>

        </Box>
    );
}
